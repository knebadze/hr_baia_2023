<?php
namespace App\Traits;

use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\HrHasVacancy;
use App\Models\GlobalVariable;
use Illuminate\Support\Facades\Auth;

trait FindHrTrait
{
    public function findHr($number, $payment)
    {
        //თუ დამსაქმებელს აქვს უკვე გამოგზავნილი ვაკანსია ვპოულობ hr და ისევ მას ვაწერ ამ ვაკანისას
        //rewrite ვუცვლი რადგან ერთი წრე გამოტოვოს
        $employer = $this->findEmployerByNumber($number);
        if ($employer) {
            $hrId = $this->findAndAssignVacancyForEmployer($employer);
            if ($hrId) {
                return $hrId;
            }
        }
        // ვამოწმობ ავტორიზებული იუზერი თუ Hr ან ადმინია, ვნახულობ რომელ ფილიალს ეკუთვნის ამის შემდეგ მის ფილიალში ვაწერ ვაკანსიას

        // ვამოწმებ თუ ვინმეს გადაეწერა ვაკანსია და იმას ვისაც ყველაზე მეტი ვაკანსია აკლია ვაძლევ შემდეგ ვაკანსისას
        // ვზრდი მინუსს increment
        $findLessReWriteHrId = $this->lessReWrite($this->auth(), $payment, $this->internship());
        if ($findLessReWriteHrId) {
            return $findLessReWriteHrId;
        }

        // ვამოწმებ ხო არ დასრულდა ვაკანსიის დაწერის ციკლი
        $this->checkCycle();
        // თუ ზედა ორი პუნქტი არ შესრულდა ვეძებ ვისაც არ მიუღია ამ წრეზე ვაკანსია
        $findNextHrId = $this->nextHr($this->auth(), $payment, $this->internship());
        if ($findNextHrId) {
            return $findNextHrId;
        }
    }

    private function findEmployerByNumber($number)
    {
        return Employer::where('number', $number)->first();
    }

    private function findAndAssignVacancyForEmployer($employer)
    {
        $vacancy = $this->findVacancyForEmployer($employer);
        if ($vacancy) {
            $hrHasVacancy = HrHasVacancy::where('hr_id', $vacancy->hr_id)->first();
            if ($hrHasVacancy) {
                $this->UpdateHrHasVacancy($hrHasVacancy, ['has_vacancy' => 1]);
                return $vacancy->hr_id;
            }

        }
        return null;
    }

    private function findVacancyForEmployer($employer)
    {
        return Vacancy::where('author_id', $employer->id)->first();
    }

    private function UpdateHrHasVacancy($hrHasVacancy, $attributes)
    {
        return $hrHasVacancy->update($attributes);
    }

    private function auth()
    {
        return Auth::guard('staff')->user();
    }

    private function internship()
    {
        return GlobalVariable::where('name', 'internship_payment')->first()->internship;
    }

    private function lessReWrite($auth, $payment, $internship)
    {
        $query = HrHasVacancy::where('re_write', '<', 0)
            ->where('is_active', 1);
        if ($auth) {
            $query = $query->whereHas('hr', function ($subQuery) use ($auth) {
                if ($auth->role_id == 2 || $auth->role_id == 1) {
                    $parent_id = $auth->role_id == 1 ? $auth->id : $auth->parent_id;
                    $subQuery->where('parent_id', $parent_id);
                }
            });
        }
        if ($payment > $internship) {
            $query = $query->whereHas('hr', function ($subQuery) {
                $subQuery->where('internship', 0);
            });
        }

        $findLessReWrite = $query->orderBy('re_write', 'ASC')->first();
        if (!$findLessReWrite) {
            return null;
        }
        $findLessReWrite->increment('re_write');
        $findLessReWrite->update(['has_vacancy' => 1]);
        return $findLessReWrite->hr_id;

    }

    private function checkCycle()
    {
        $checkCycle = HrHasVacancy::where('has_vacancy', 0)->where('is_active', 1)->count();
        if ($checkCycle == 0) {
            $this->hrHasVacancyUpdate();
        }
    }

    private function nextHr($auth, $payment, $internship)
    {
        $nextHr = HrHasVacancy::orderBy('id', 'ASC')
            ->where('has_vacancy', 0)
            ->where('is_active', 1);

        if ($auth && ($auth->role_id == 1 || $auth->role_id == 2)) {
            $parent_id = $auth->role_id == 1 ? $auth->id : $auth->parent_id;
            $nextHr->whereHas('hr', function ($query) use ($parent_id) {
                $query->where('parent_id', $parent_id);
            });
            if (!$nextHr->exists()) {
                $nextHr = $this->getAuthAdminHrs($parent_id );
            }
        }

        $nextHr->when($payment > $internship, function ($query) {
            $query->whereHas('hr', function ($subQuery) {
                $subQuery->where('internship', 0);
            });
        });

        $findNext = $nextHr->first();
        if (!$findNext) {
            return null;
        }
        $findNext->update(['has_vacancy'=> 1]);
        return $findNext->hr_id;
    }

    private function getAuthAdminHrs ($parent_id ) {
        return HrHasVacancy::whereHas('hr', function ($query) use ($parent_id ) {
            $query->where('parent_id', $parent_id );
        })->where('re_write', '<=', 0)->where('is_active', 1)->orderBy('id', 'ASC');
    }

    private function hrHasVacancyUpdate()
    {
        // Directly update records where re_write <= 1 to set has_vacancy to 0
        HrHasVacancy::where('re_write', '<=', 1)->update(['has_vacancy' => 0]);

        // For records with re_write > 0, decrement re_write by 1
        // This approach avoids loading models into memory and operates directly on the database
        HrHasVacancy::where('re_write', '>', 0)->decrement('re_write');

    }
}
