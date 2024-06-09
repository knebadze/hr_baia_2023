import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export const toastNotification = (message, type, theme = 'colored', autoClose = 1000) => {
    toast[type](message, {
        theme: theme,
        autoClose: autoClose,
    });
}
