import 'vue3-toastify/dist/index.css';
import { toast } from "vue3-toastify";

export const toastNotification = (text,type) =>{
    toast(text, {
        autoClose: 2000,
        theme: "auto",
        type: type,
        position: "top-right",
        dangerouslyHTMLString: true
    });
}