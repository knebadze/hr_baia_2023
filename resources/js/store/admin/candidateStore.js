import { defineStore } from 'pinia';

export const useCandidateStore = defineStore('candidate', {
    state: () => ({
        candidate: [],
        pagination: {
            current_page: 1,
            last_page: 2,
        },
    }),
    actions: {
        async fetchCandidates(page) {
            console.log(page);
            try {
                const response = await axios.get(`/fetch_candidate?page=${page}`);
                const data = response.data;
                // Update the store's state
                this.candidate = data.data;
                this.pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                };
            } catch (error) {
                console.error('Error fetching candidates:', error);
                throw error; // Propagate the error to the caller
            }
        },
        async filterCandidates(page, filterData) {
            try {
                const response = await axios.post(`/candidate_filter?page=${page}`, filterData);
                const data = response.data;

                // Update the store's state
                this.candidate = data.data;
                this.pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                };
            } catch (error) {
                console.error('Error filtering candidates:', error);
                throw error; // Propagate the error to the caller
            }
        },
    },
});

