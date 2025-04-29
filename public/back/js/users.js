import { request } from "./utils.js";

const page_lang = document.querySelector("html").getAttribute("lang")
const lang = await import("../libs/intl-tel-input/js/i18n/" + page_lang + "/index.js")
let iti = null

if(document.querySelector("input.country-selector"))
{
    iti = window.intlTelInput(document.querySelector("input.country-selector"), {
        i18n: lang,
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("UAE"));
        },
        strictMode: true,
        separateDialCode: true,
        allowDropdown: true,
        autoPlaceholder: "aggressive",
        hiddenInput: (telInputName) => ({
            phone: "phone_numer",
            country: "country_code"
        }),
        loadUtils: () => import("../libs/intl-tel-input/js/utils.js"),
    });
}

document.querySelector("form#create-user-form button#create")?.addEventListener("click", async (e) => {
    create_account(e)
})

async function create_account(e) {
    e.preventDefault()

    const form = document.querySelector("form#create-user-form")
    const formData = new FormData(form)

    formData.set("phone_number", iti.getNumber())
    formData.set("country_code", iti.getSelectedCountryData().iso2.toUpperCase())

    const submit_button = document.querySelector("button#create")
    submit_button.disabled = true

    const response = await request("/dashboard/users", "POST", formData)

    if(response.success) {
        form.querySelectorAll("input:not([name='_token']").forEach(input => input.value = "")
        form.querySelector("select").value = ""
        form.querySelector("img").src = form.querySelector("img").getAttribute("default-src")
        Swal.fire({
            text: response.data.message,
            icon: "success"
        });
    }
    else
    {
        Swal.fire({
            text: response.message,
            icon: "error"
        });
    }

    submit_button.disabled = false
}

document.querySelector("body").addEventListener("click", function(e) {
    if(e.target.closest("button.remove_button"))
    {
        Swal.fire({
            title: "Do you really want to delete this person?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "red",
        }).then((result) => {
            if (result.isConfirmed) {
                remove(e.target.closest("form"))
            }
        });
    }
})

const remove = async function(form) {
    const formData = new FormData(form);
    
    let id = form.getAttribute("data-id")
    
    const response = await request(`/dashboard/users/${id}`, "POST", formData)

    if(response.success) {
        Swal.fire({
            text: response.data.message,
            icon: "success"
        })
        table.ajax.reload(null, false)
    }
    else
    {
        Swal.fire({
            text: response.message,
            icon: "error"
        })
    }
}

document.querySelector("form#edit-user-form")?.addEventListener('submit', async function(e) {

    e.preventDefault()

    const formData = new FormData(this)

    formData.set("phone_number", iti.getNumber())
    formData.set("country_code", iti.getSelectedCountryData().iso2.toUpperCase())

    const submit_button = this.querySelector("button[type='submit']")
    submit_button.disabled = true

    const user_id = this.getAttribute("data-id")

    const response = await request(`/dashboard/users/${user_id}`, "POST", formData)

    if(response.success) {
        Swal.fire({
            text: response.data.message,
            icon: "success"
        })
    }
    else
    {
        Swal.fire({
            text: response.message,
            icon: "error"
        })
    }
    submit_button.disabled = false
})