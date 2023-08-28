<template lang="">
         <!-- Modal -->
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">ახალი HR - ის დამატება</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">სახელი გვარი</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" v-model="model.name" placeholder="სახელი გვარი">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" v-model="model.email" placeholder="ემაილი">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">საკუთარი ტელეფონის ნომერი</label>
                            <input type="text" class="form-control" id="exampleInputEmail3" v-model="model.mobile" placeholder="საკუთარი ტელეფონის ნომერი" minlength="9">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">დაბადების თარიღი</label>
                            <input type="date" class="form-control" v-model="model.date_of_birth" id="exampleInputEmail4">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="">სქესი</label>
                        <div class="form-group d-flex border rounded p-2">

                            <div class="form-check mr-2">
                                <input class="form-check-input" type="radio" value="1" v-model="model.gender">
                                <label class="form-check-label">კაცი</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="2" v-model="model.gender">
                                <label class="form-check-label">ქალი</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">პირადი ნომერი</label>
                            <input type="text" class="form-control" id="exampleInputEmail7" v-model="model.person_number" placeholder="პირადი ნომერი" minlength="11">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">ატვირთე სურათი</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" @change="avatarUpload">
                                    <label class="custom-file-label" for="exampleInputFile">{{ imgName }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputFile">პაროლი</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="exampleInputPassword1" v-model="model.password" placeholder="Password">
                                <div class="input-group-append">
                                    <button class="btn btn-info" @click="generatePassword">პაროლის გენერირება</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">კორპორატიული ნომერი</label>
                            <input type="text" class="form-control" id="exampleInputEmail5" v-model="model.k_mobile" placeholder="კორპორატიული ნომერი" minlength="9">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">შიდა ნომერი</label>
                            <input type="text" class="form-control" id="exampleInputEmail6" v-model="model.inside_number" placeholder="შიდა ნომერი">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ბონუსის პროცენტი</label>
                            <input type="number" class="form-control" id="exampleInputEmail6" v-model="model.bonus_percent" placeholder="ვაკანსისი ბონუსის პროცენტი" step="0.5">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ფიქსირებული ხელფასი</label>
                            <input type="number" class="form-control" id="exampleInputEmail6" v-model="model.fixed_salary" placeholder="ფიქსირებული ხელფასი">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Facebook ლინკი</label>
                            <input type="text" class="form-control" id="exampleInputEmail8" v-model="model.fb_link" placeholder="Facebook ლინკი">
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->


            </div>
            <div  class="modal-footer">
                <button type="button" class="btn btn-success" @click="addHR(model)" ><i class=""></i>დამატება</button>
            </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props:{
        visible: Boolean,
    },
    data() {
        return {
            showConfirm: false,
            model:{
                'name':'',
                'email':'',
                'mobile':'',
                'date_of_birth':'',
                'gender':'',
                'person_number':'',
                'k_mobile':'',
                'inside_number':'',
                'fb_link':'',
                'password':''
            },
            avatar:null,
            imgName: 'აირჩიე სურათი'
        }
    },
    created(){
        // this.showConfirm = this.visible
    },
    methods:{
        show(){
            this.showConfirm = true
        },
        hide(){
           this.showConfirm = false
        },
        generatePassword() {
            let result = "";
            let characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*";
            let charactersLength = characters.length;
            for (let i = 0; i < 8; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            this.model.password = result;
        },
        avatarUpload(event){
            this.avatar = event.target.files[0]
            this.imgName = event.target.files[0].name
        },
        addHR(model){
            console.log('model', model);
            let currentObj = this
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            formData.append('name',model.name)
            formData.append('email',model.email)
            formData.append('mobile',model.mobile)
            formData.append('date_of_birth',model.date_of_birth)
            formData.append('gender',model.gender)
            formData.append('person_number',model.person_number)
            formData.append('k_mobile',model.k_mobile)
            formData.append('inside_number',model.inside_number)
            formData.append('fb_link',model.fb_link)
            formData.append('password',model.password)
            if (this.avatar != null) {
                formData.append('avatar', this.avatar);
            }else{
                formData.append('avatar', '');
            }



            axios.post('/add_hr', formData, config)
            .then(function (response) {
                console.log('this.noticeFile',currentObj);
                // handle success
                console.log('response.data',response.data);
                if (response.status == 200) {
                    // currentObj.candidate_id = response.data.data;
                    currentObj.hide()
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);
                    // // alert()

                }
            })
            .catch(function (error) {
                console.log(error);
            })
        },
    },
    watch:{
        visible: function(){
            this.show()
        },
    }
}
</script>
<style lang="">

</style>
