const SignInSwitch = document.getElementById('signin');
const SignUpSwitch = document.getElementById('signup');
const FooterHidden = document.getElementById('main-footer');
FooterHidden.style.display="block";
function Switch(){
    SignInSwitch.style.display="none";
    SignUpSwitch.style.display="flex";
    SignUpSwitch.style.marginBottom="4rem";
    if(SignUpSwitch.style.display=="flex"){
        FooterHidden.style.display="none";
    }
}
function Switch2(){
       SignInSwitch.style.display="flex";
       SignUpSwitch.style.display="none";
       FooterHidden.style.display="block";
}