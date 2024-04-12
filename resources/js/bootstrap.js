import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const previewImage = () => {
    const image = document.querySelector("#foto");
    const imagePreview = document.querySelector(".img-preview");

    if (image.files.length > 0) {
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = (oFREvent) => {
            imagePreview.src = oFREvent.target.result;
            image.classList.add("mt-2");
        };
    }
};

document.querySelector("#foto").addEventListener("change", previewImage);

document.querySelector("#no-hp").addEventListener("change", function (e) {
    let phone = e.target.value;
    if (phone.startsWith("+62")) {
        phone = "0" + phone.slice(3);
        e.target.value = phone;
    }
});

const emailInput = document.querySelector("#email");
const nimInput = document.querySelector("#nim");
const formEmailHelp = document.querySelector("#form-email-help");

nimInput.addEventListener("change", function (e) {
    const nim = e.target.value;
    const defaultEmailDomain = "@unima.ac.id";
    emailInput.value = nim + defaultEmailDomain;

    formEmailHelp.innerHTML = `<small>Email Otomatis Diganti Menjadi ${emailInput.value}. Silahkan Diganti Jika Kurang Sesuai.</small>`;
    setTimeout(() => {
        formEmailHelp.innerHTML = "";
    }, 10000);
});
