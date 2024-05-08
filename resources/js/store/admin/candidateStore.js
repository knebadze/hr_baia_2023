import { defineStore } from 'pinia';

export const useCandidateStore = defineStore('candidate', {
    state: () => ({
        candidate: [],
        pagination: {
            current_page: 1,
            last_page: 2,
        },
        count: 0,
    }),
    actions: {
        async fetchCandidates(page) {
            try {
                const response = await axios.get(`/fetch_candidate?page=${page}`);
                const data = response.data;
                const { candidates, total } = data;
                // Update the store's state
                this.candidate = candidates.data;
                this.pagination = {
                    current_page: candidates.current_page,
                    last_page: candidates.last_page,
                };
                this.count = total;
            } catch (error) {
                console.error('Error fetching candidates:', error);
                throw error; // Propagate the error to the caller
            }
        },
        async filterCandidates(page, filterData) {
            try {
                const response = await axios.post(`/candidate_filter?page=${page}`, filterData);
                const data = response.data;
                const { candidates, total } = data;
                // Update the store's state
                this.candidate = candidates.data;
                this.pagination = {
                    current_page: candidates.current_page,
                    last_page: candidates.last_page,
                };
                this.count = total;
            } catch (error) {
                console.error('Error filtering candidates:', error);
                throw error; // Propagate the error to the caller
            }
        },
    },
});

