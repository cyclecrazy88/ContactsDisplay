class LoginRequestHander {
  constructor() {
      this.result = this.makeLogin()
  }
  makeLogin() {
    var thisRef = this;
    document.querySelector('form.sendForm').
        addEventListener('submit', async (eventData) => {
            eventData.stopPropagation()
            eventData.stopImmediatePropagation()
            eventData.preventDefault()
            if (eventData instanceof SubmitEvent){

                var formInput =
                    new FormData(document.querySelector("form.sendForm"))
                var searchParms = new URLSearchParams(formInput)

                if (document.querySelector("input.register:checked") instanceof Object){
                    searchParms.set("register",true)
                    searchParms.set("email",document.querySelector("input.email").value)
                }

                var loginRequest = await fetch("/loginRequest/",{
                    method:"POST",
                    body:searchParms.toString(),
                    cache:'no-cache',
                    headers:{
                       "X-CSRF-TOKEN":document.querySelector("input[name=_token]").getAttribute("value")
                    }
                })

            }
            return false
        });
  }
}

document.addEventListener('DOMContentLoaded', function () {
  new LoginRequestHander();
});
