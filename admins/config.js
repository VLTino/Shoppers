CKEditor.editorConfig = function( config ) {
    // Tambahkan opsi font size pada toolbar
    config.toolbarGroups = [
      { name: 'styles', groups: [ 'styles' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
      { name: 'links' },
      { name: 'insert' },
      { name: 'tools' },
      { name: 'others' },
      { name: 'about' }
    ];
  
    config.stylesSet = 'my_styles';
  
    // Tentukan opsi font size
    config.fontSize_sizes = '8/8px;9/9px;10/10px;12/12px;14/14px;16/16px;18/18px;20/20px;24/24px;28/28px;32/32px;36/36px;48/48px;72/72px';
  
    // Atur format font size
    config.format_sizes = '8px 9px 10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px 72px';
  };
  