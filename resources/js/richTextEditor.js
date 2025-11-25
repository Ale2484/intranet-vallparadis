document.addEventListener("DOMContentLoaded", () => {
    console.log("Funciona")
  var editorContainer = document.querySelector('#rich-editor-container');
  
  if (editorContainer) {
    console.log("1");
    const quill = new Quill('#rich-editor-container', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          ['bold', 'italic', 'underline'],
          [{ 'align': [] }]
        ]
      },
      placeholder: 'Escribe aquí tu contenido...',
    });

    let hiddenInput = document.getElementById(editorContainer.dataset.idInput);
    if (hiddenInput) {
        quill.on("text-change", () => {
            hiddenInput.value = quill.root.innerHTML;
            console.log(hiddenInput.value);
      });
    }
  }
});
