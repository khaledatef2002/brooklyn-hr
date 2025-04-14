import { request } from './utils.js'

const language = document.querySelector("html").getAttribute("lang")

const enable_job_application_form = function()
{
    document.querySelector("form#apply-job")?.addEventListener('submit', async function(e){
        e.preventDefault()

        const form = this
        const formData = new FormData(form)
        
        const submit_button = form.querySelector("button[type='submit']")
        submit_button.disabled = true

        const response = await request(`/${language}/apply`, "POST", formData)
        
        if(response.success) {
            form.querySelectorAll("input:not([name='_token']):not([type='checkbox']):not([type='radio'])").forEach(input => input.value = "")
            form.querySelectorAll("textarea").forEach(input => input.value = "")
            form.querySelectorAll("select").forEach(input => input.value = "")
            form.querySelectorAll("input[type='checkbox']").forEach(input => input.checked = false)
            form.querySelectorAll("input[type='radio']").forEach(input => input.checked = false)
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
}

function init()
{
    enable_job_application_form()
}

init()