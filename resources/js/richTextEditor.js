document.addEventListener("DOMContentLoaded", () => {
  var editorContainer = document.querySelector('#rich-editor-container');
  
  if (editorContainer) {
    const quill = new Quill('#rich-editor-container', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ "header": "1" }, { "header": "2" }, {"font": []}],
          [{ "list": "ordered" }, { "list": "bullet" }],
          ["bold", "italic", "underline"],
          [{ "align": [] }],
          [{"background": []}],
          [{"color": []}]
        ]
      },
      placeholder: 'Escriu aquí el personal i els seus horaris...',
    });
    let hiddenInput = document.getElementById(editorContainer.dataset.idInput);
    if (hiddenInput) {
      // Si es la vista de edicion, se añade el contenido
      if (hiddenInput.value) {
        quill.root.innerHTML = hiddenInput.value;
      }
        quill.on("text-change", () => {
            hiddenInput.value = quill.root.innerHTML;
      });
    }
  }
});
