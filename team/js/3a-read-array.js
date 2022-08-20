document.getElementById("demo").onchange = (evt) => {
  // (A) NEW FILE READER
  var reader = new FileReader();

  // (B) ON FINISH LOADING
  reader.addEventListener("loadend", (evt) => {
    // (B1) GET THE FIRST WORKSHEET
    var workbook = XLSX.read(evt.target.result, {type: "binary"}),
        worksheet = workbook.Sheets[workbook.SheetNames[0]],
        range = XLSX.utils.decode_range(worksheet["!ref"]);

    // (B2) READ CELLS IN ARRAY
    $('.remover').remove();
    var data = [];
    var html="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='informe'>";
    for (let row=range.s.r; row<=range.e.r; row++) {
      let i = data.length;
      data.push([]);
      for (let col=range.s.c; col<=range.e.c; col++) {
        let cell = worksheet[XLSX.utils.encode_cell({r:row, c:col})];
        data[i].push(cell.v);
      }
      html=html+"<p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][0]+"</p><p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][1]+"</p><p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][2]+"</p>"
    }
    html=html+"</div>";
    $('#cargarInformediv').after(html);
  });

  // (C) START - READ SELECTED EXCEL FILE
  reader.readAsArrayBuffer(evt.target.files[0]);
};
document.getElementById("dinero").onchange = (evt) => {
  // (A) NEW FILE READER
  var reader = new FileReader();

  // (B) ON FINISH LOADING
  reader.addEventListener("loadend", (evt) => {
    // (B1) GET THE FIRST WORKSHEET
    var workbook = XLSX.read(evt.target.result, {type: "binary"}),
        worksheet = workbook.Sheets[workbook.SheetNames[0]],
        range = XLSX.utils.decode_range(worksheet["!ref"]);

    // (B2) READ CELLS IN ARRAY
    $('.remover').remove();
    var data = [];
    var html="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='informeD'>";
    for (let row=range.s.r; row<=range.e.r; row++) {
      let i = data.length;
      data.push([]);
      for (let col=range.s.c; col<=range.e.c; col++) {
        let cell = worksheet[XLSX.utils.encode_cell({r:row, c:col})];
        data[i].push(cell.v);
      }
      html=html+"<p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][0]+"</p><p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][1]+"</p><p class='remover letra18pt-pc col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+ data[i][2]+"</p>"
    }
    html=html+"</div>";
    $('#cargarInformeDinero').after(html);
  });

  // (C) START - READ SELECTED EXCEL FILE
  reader.readAsArrayBuffer(evt.target.files[0]);
};