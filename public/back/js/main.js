import { request } from "./utils.js";

const enable_login = function() 
{
    document.querySelector("form#login-form")?.addEventListener("submit", async function(e) {
        e.preventDefault()
        
        const formData = new FormData(this)
        
        const submit_button = $(this).find("button[type='submit']")
        submit_button.prop("disabled", true)

        const response = await request("/login", "POST", formData)

        if(response.success) {
            location.reload()
        }
        else
        {
            Swal.fire({
                text: response.message,
                icon: "error"
            });
            submit_button.prop("disabled", false)
        }
    })
}

const enable_password_toggler = function()
{
    document.querySelectorAll("div.password-toggler").forEach(function(div) {
        div.querySelector("i").addEventListener("click", function() {
            if(div.querySelector("input").getAttribute("type") == "password")
            {
                this.classList.remove("ri-eye-line")
                this.classList.add("ri-eye-off-line")
                div.querySelector("input").setAttribute("type", "text")
            }
            else
            {
                this.classList.add("ri-eye-line")
                this.classList.remove("ri-eye-off-line")
                div.querySelector("input").setAttribute("type", "password")
            }
        })
    })

}

const enable_send_reset_password = function()
{
    document.querySelector("form#forgot-password-form")?.addEventListener("submit", async function(e) {
        e.preventDefault()
        const form = $(this)
        const formData = new FormData(this)
        
        const submit_button = $(this).find("button[type='submit']")
        submit_button.prop("disabled", true)

        const response = await request("/forgot-password", "POST", formData)

        if(response.success) {
            console.log(response)
            Swal.fire({
                text: response.data.message,
                icon: "success"
            });
            $("input[name='email']").val("")    
        }
        else
        {
            Swal.fire({
                text: response.message,
                icon: "error"
            });
        }
        submit_button.prop("disabled", false)
    })
}

const enable_reset_password = function()
{
    document.querySelector("form#reset-password-form")?.addEventListener("submit", async function(e) {
        e.preventDefault()
        const form = $(this)
        const formData = new FormData(this)
        
        const submit_button = $(this).find("button[type='submit']")
        submit_button.prop("disabled", true)

        const response = await request("/reset-password", "POST", formData)

        if(response.success) {
            window.location = response.data.redirect
        }
        else
        {
            Swal.fire({
                text: response.message,
                icon: "error"
            });
        }
        submit_button.prop("disabled", false)
    })
}

function init()
{
    enable_login()
    enable_password_toggler()
    enable_send_reset_password()
    enable_reset_password()
}

init()