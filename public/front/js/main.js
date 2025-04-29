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

const allow_image_input_file_display = function()
{
    document.querySelectorAll(".auto-image-show").forEach(e => {
        const fileInput = e.querySelector("input[type='file']");
        const preview = e.querySelector("img")
    
        fileInput.addEventListener('change', function() {
          const file = this.files[0];
          if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
              preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
          } else {
          }
        });

        e.querySelector('.choose_gallery').addEventListener('click', function() {
            e.querySelector("input[type='file']").setAttribute('capture', 'environment')
            e.querySelector("input[type='file']").click()
        })

        e.querySelector('.choose_camera').addEventListener('click', function() {
            e.querySelector("input[type='file']").setAttribute('capture', 'user')
            e.querySelector("input[type='file']").click()
        })
    })


}


function init()
{
    enable_job_application_form()

    allow_image_input_file_display()
}

init()