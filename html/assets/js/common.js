// //운영정보 알아내기
// let os = navigator.userAgent.toLocaleLowerCase();
// if(os.indexOf("macintosh")>-1){
//     document.querySelector("body").classList.add("macintosh");

// }else if(os.indexOf("windows")>-1){
//     document.querySelector("body").classList.add("windows");
//     // console.log(os)
// }else if(os.indexOf("iphone")>-1){
//     document.querySelector("body").classList.add("iphone");
//     // console.log(os)
// }else if(os.indexOf("android")>-1){
//     document.querySelector("body").classList.add("android");
//     // console.log(os)
// }
document.querySelector(".kategorie").addEventListener("mouseover", e => {
    document.querySelector(".kategorie ul").style.display = "block";
});
document.querySelector(".kategorie").addEventListener("mouseout", e => {
    document.querySelector(".kategorie ul").style.display = "none";
});

document.querySelector(".user").addEventListener("mouseover", e => {
    document.querySelector(".user ul").style.display = "block";
});
document.querySelector(".user").addEventListener("mouseout", e => {
    document.querySelector(".user ul").style.display = "none";
});
    