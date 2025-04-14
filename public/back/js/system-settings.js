import { request } from './utils.js'

document.querySelector("form#edit-system-settings-form")?.addEventListener("submit", async function(e) {
    e.preventDefault()
    
    const form = this
    const formData = new FormData(form)
    formData.append("_method", "PUT")

    const submit_button = this.querySelector("button[type='submit']")
    submit_button.disabled = true

    const response = await request("/dashboard/system-settings", "POST", formData)

    if(response.success) {
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
})