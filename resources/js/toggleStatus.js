// document.addEventListener("DOMContentLoaded", () => {
//     let toggleButtons = document.querySelectorAll(".toggle-status-btn");
//     toggleButtons.forEach(button => {
//         button.addEventListener("click", async () => {
//             // Se obtienen los datos de los botones
//             let id = button.dataset.id;
//             let type = button.dataset.type;
//             const meta = document.querySelector('meta[name="csrf-token"]');
//             const token = meta ? meta.getAttribute('content') : '';
//             let newStatus = button.dataset.active == "1" ? "activate" : "deactivate" ;
    
//             console.log(`El id es: ${id} se intenta ${newStatus}`);
//             try {
//                 let response = await fetch(`${type}/${id}/${newStatus}`, {
//                     method: "PATCH",
//                     headers: {
//                         "Content-Type": "application/json",
//                         "X-CSRF-TOKEN": token,
//                         "Accept": "application/json" 
//                     }
//                 });
//                 let data = await response.json();
//             } catch (error) {
                
//             }
//         });
//     })
// });