window.addEventListener("closeModel", event => {
$(".closeModal").modal('hide');
$('.modal-backdrop').remove();


});

//success message dialog
window.addEventListener('MSGsuccessfull', event =>{
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
      
      Toast.fire({
        icon: 'success',
        title: event.detail.title
      });
});

//delete window dialog
window.addEventListener('Swal:DeletedRecord', event =>{

    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(result => {
          if (result.isConfirmed) 
          {
              window.livewire.emit('RecordDeleted', event.detail.id)
              Swal.fire("Deleted!","Redord Deleted Successfully.", "success");
          }
      }); 

});

window.addEventListener('Swal:Successful', event=>{

 
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Transaction Saved',
    showConfirmButton: false,
    timer: 1500
  })


})