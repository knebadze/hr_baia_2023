import { defineStore, storeToRefs } from "pinia";
import { ref, reactive, watch } from "vue";
import { useLoadingStore } from "../../loaderStore";
import { toast } from "vue3-toastify";
import _, { min } from "lodash";

export const useDepositStore = defineStore("depositStore", () => {
    const deposit = ref({});
    const responseData = ref({});
    const loadingStore = useLoadingStore();
    const { setLoading } = loadingStore;

    // const setDeposit = (data) => {
    //     deposit.value = data;
    // };

    // const getInfo = async () => {
    //     try {
    //         const response = await axios.post("/get_deposit_info", {
    //             data: deposit.value.id,
    //         });
    //         responseData.value = response.data;
    //     } catch (error) {
    //         console.log(error);
    //     }
    // };

    const save = async (deposit) => {
        try {
            console.log('deposit',deposit);

            setLoading(true);
            const response = await axios.post("/save_deposit_cancel", {
                data: deposit,
            });
            if(response.status == 200){
                toast.success("დეპოზიტი გაუქმებულია");
                setTimeout(() => {
                    document.location.reload();
                }, 2000);
            }
            // responseData.value = response.data;
            setLoading(false);
        } catch (error) {
            toast.error("დაფიქსირდა შეცდომა");
            console.log(error);
            setLoading(false);
        }
    }

    return {
        save,
        // ...storeToRefs({
        //     deposit,
        //     responseData,
        // }),
        // setDeposit,
        // getInfo,
    };
});
