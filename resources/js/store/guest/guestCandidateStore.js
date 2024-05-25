import { defineStore, storeToRefs } from 'pinia';
import { ref } from 'vue';
import { useLoadingStore } from '../loaderStore';
export const useGuestCandidateStore = defineStore('guestCandidate', () =>{

    const candidates = ref([]);
    const pagination = ref({
        current_page: 1,
        last_page: 2,
    });
    const cla = ref([]);
    const count = ref(0);

    const loadingStore = useLoadingStore();
    const { loadingActive } = storeToRefs(loadingStore);
    const setCla = (classificatory) =>{
        cla.value = classificatory;
    }
    const fetchCandidates = async (page) => {
        try {
            loadingActive.value = true;
            const response = await axios.get(`/guest_fetch_candidate?page=${page}`);
            console.log('response', response);
            const data = response.data;
            const { candidate, classificatory, total } = data

            // Update the store's state
            candidates.value = candidate.data;
            pagination.value = {
                current_page: candidate.current_page,
                last_page: candidate.last_page,
            };
            cla.value = classificatory;
            count.value = total;
            loadingActive.value = false;
        } catch (error) {
            console.error('Error fetching candidates:', error);
            loadingActive.value = false;
            throw error; // Propagate the error to the caller
        }
    };

    const filterCandidates = async (page, filterData) => {
        try {
            loadingActive.value = true;
            const response = await axios.post(`/guest_candidate_filter?page=${page}`, filterData);
            const data = response.data;

            const { candidate, total } = data

            // Update the store's state
            candidates.value = candidate.data;
            pagination.value = {
                current_page: candidate.current_page,
                last_page: candidate.last_page,
            };
            count.value = total;
            loadingActive.value = false;
        } catch (error) {
            console.error('Error filtering candidates:', error);
            loadingActive.value = false;
            throw error; // Propagate the error to the caller
        }
    };


    return {
        candidates,
        pagination,
        cla,
        count,
        loadingActive,
        fetchCandidates,
        filterCandidates,
        setCla
    };
});
