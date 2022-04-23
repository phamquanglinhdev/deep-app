require('./bootstrap');
Echo.private("notification")
    .listen("CreateNotification",(e)=>{
    console.log(e);
})
