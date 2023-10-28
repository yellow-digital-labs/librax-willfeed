/**
 * Form Editors
 */

'use strict';

(function () {
  // Snow Theme
  // --------------------------------------------------------------------
  const snowEditor = new Quill('#snow-editor', {
    bounds: '#snow-editor',
    modules: {
      formula: true,
      toolbar: '#snow-toolbar'
    },
    theme: 'snow'
  });

  snowEditor.pasteHTML(description);

  snowEditor.on('text-change', () => {
      $("#text_quill").val(snowEditor.root.innerHTML);
  });
})();
