$(function() {
  var npk = [];
  var nama = [];
  var grade = [];
  var pos_name = [];
  var pbp = [];
  var pensiun = [];
  var mdg = [];
  var mdj = [];
  var unit_kerja = [];
  var tgl_pbp = [];
  var tgl_pensiun = [];
  var lokasi_kerja = [];
  var status_ajuan = [];
  var lokasi_usulan = [];
  var id_usulan = [];
  var status_usulan = [];
  var counter = 0;
  var approver_GM_asal = [];
  var tanggal_approve_GM_asal = [];
  var catatan_GM_asal = [];
  var RP_usulan = [];
  var dataGrid = $("#grid-container")
    .dxDataGrid({
      dataSource: sales,
      columnAutoWidth: true,
      rowAlternationEnabled: true,
      keyExpr: "nama",
      showBorders: true,
      pager: {
        allowedPageSizes: [5, 10, 15, 30, 50, 100],
        showInfo: true,
        showNavigationButtons: true,
        showPageSizeSelector: true,
        visible: true
      },
      selection: {
        showCheckBoxesMode: "always",
        mode: "multiple"
      },
      onToolbarPreparing: function(e) {
        e.toolbarOptions.items.push({
          widget: "dxButton",
          showText: "always",
          options: {
            icon: "export",
            text: "Export Selected to Excel",
            onClick: function() {
              e.component.exportToExcel(true);
            }
          },
          location: "after"
        });

        e.toolbarOptions.items.push({
          widget: "dxButton",
          showText: "always",
          options: {
            icon: "export",
            text: "Export All to Excel",
            onClick: function() {
              e.component.exportToExcel(false);
            }
          },
          location: "after"
        });
      },
      paging: {
        pageSize: 10
      },
      filterRow: {
        visible: true
      },
      columns: [
        {
          dataField: "nama",
          caption: "Nama"
        },
        {
          dataField: "NPK",
          caption: "NPK"
        },
        {
          dataField: "grade",
          caption: "Grade"
        },
        {
          dataField: "pos_name",
          caption: "Jabatan"
        },
        {
          dataField: "PBP",
          caption: "Tanggal PBP",
          visible: false
        },
        {
          dataField: "nama_unit_kerja",
          caption: "Unit Kerja"
        },
        {
          dataField: "kode_unit_kerja",
          caption: "kode_unit_kerja",
          visible: false
        },
        {
          dataField: "id_usulan",
          caption: "id_usulan",
          visible: false
        },
        {
          dataField: "status_usulan",
          caption: "status_usulan",
          visible: false
        },
        {
          dataField: "approver_GM_asal",
          caption: "approver_GM_asal",
          visible: false
        },
        {
          dataField: "tanggal_approve_GM_asal",
          caption: "tanggal_approve_GM_asal",
          visible: false
        },
        {
          dataField: "catatan_GM_asal",
          caption: "catatan_GM_asal",
          visible: false
        },
        {
          dataField: "lokasi_kerja",
          caption: "lokasi_kerja",
          visible: false
        },
        {
          dataField: "pensiun",
          caption: "Tanggal Pensiun",
          visible: false
        },
        {
          dataField: "MDG",
          sortOrder: "desc",
          sortIndex: 0,
          caption: "MDG",
          visible: false
        },
        {
          dataField: "MDJ",
          sortOrder: "desc",
          sortIndex: 1,
          caption: "MDJ",
          visible: false
        },
        {
          dataField: "status_ajuan",
          caption: "Status Usulan"
        },
        {
          dataField: "jenis_usulan",
          caption: "jenis_usulan",
          visible: false
        },
        {
          dataField: "unit_kerja_usulan",
          caption: "unit_kerja_usulan",
          visible: false
        },
        {
          dataField: "grade_usulan",
          caption: "grade_usulan",
          visible: false
        },
        {
          dataField: "jabatan_usulan",
          caption: "jabatan_usulan",
          visible: false
        },
        {
          dataField: "keterangan_usulan",
          caption: "keterangan_usulan",
          visible: false
        },
        {
          dataField: "pengusul",
          caption: "pengusul",
          visible: false
        },
        {
          dataField: "lokasi_usulan",
          caption: "lokasi_usulan",
          visible: false
        },
        {
          dataField: "tanggal_usulan",
          caption: "tanggal_usulan",
          visible: false
        },
        {
          dataField: "RP_usulan",
          caption: "RP_usulan",
          visible: false
        }
      ],
      onSelectionChanged: function(selectedItems) {
        counter = 0;
        var data = selectedItems.selectedRowsData;
        console.log(data);
        npk = [];
        nama = [];
        grade = [];
        pos_name = [];
        pbp = [];
        pensiun = [];
        mdg = [];
        mdj = [];
        unit_kerja = [];
        lokasi_kerja = [];
        status_ajuan = [];
        kode_unit_kerja = [];
        jenis_usulan = [];
        unit_kerja_usulan = [];
        grade_usulan = [];
        jabatan_usulan = [];
        keterangan_usulan = [];
        pengusul = [];
        lokasi_usulan = [];
        tanggal_usulan = [];
        id_usulan = [];
        status_usulan = [];
        approver_GM_asal = [];
        tanggal_approve_GM_asal = [];
        catatan_GM_asal = [];
        RP_usulan = [];
        data.forEach(function(test) {
          npk.push(test.NPK);
          nama.push(test.nama);
          grade.push(test.grade);
          pos_name.push(test.pos_name);
          pbp.push(test.PBP);
          pensiun.push(test.pensiun);
          mdg.push(test.MDG);
          mdj.push(test.MDJ);
          unit_kerja.push(test.nama_unit_kerja);
          kode_unit_kerja.push(test.kode_unit_kerja);
          lokasi_kerja.push(test.lokasi_kerja);
          if (test.status_ajuan != "") {
            status_ajuan.push("--");
          } else {
            status_ajuan.push("");
          }
          id_usulan.push(test.id_usulan);
          jenis_usulan.push(test.jenis_usulan);
          unit_kerja_usulan.push(test.unit_kerja_usulan);
          grade_usulan.push(test.grade_usulan);
          jabatan_usulan.push(test.jabatan_usulan);
          keterangan_usulan.push(test.keterangan_usulan);
          pengusul.push(test.pengusul);
          tanggal_usulan.push(test.tanggal_usulan);
          lokasi_usulan.push(test.lokasi_usulan);
          status_usulan.push(test.status_usulan);
          approver_GM_asal.push(test.approver_GM_asal);
          tanggal_approve_GM_asal.push(test.tanggal_approve_GM_asal);
          catatan_GM_asal.push(test.catatan_GM_asal);
          RP_usulan.push(test.RP_usulan);
          console.log(test.id_usulan);
        });
        console.log(npk);
      }
    })
    .dxDataGrid("instance");

  $("#select-all-mode").dxSelectBox({
    dataSource: ["allPages", "page"],
    value: "allPages",
    onValueChanged: function(data) {
      dataGrid.option("selection.selectAllMode", data.value);
    }
  });

  $("#show-checkboxes-mode").dxSelectBox({
    dataSource: ["none", "onClick", "onLongTap", "always"],
    value: "always",
    onValueChanged: function(data) {
      dataGrid.option("selection.showCheckBoxesMode", data.value);
      //console.log(dataGrid.getSelectedRowKeys());
      //console.log(dataGrid.getSelectedRowsData());
      $("#select-all-mode")
        .dxSelectBox("instance")
        .option("disabled", data.value === "none");
    }
  });

  $("#buat").click(function() {
    if (npk.length < 1) {
      alert("Harap pilih usulan!");
    }
    if (npk.length < 2) {
      console.log(npk);
      $("#npks").val(npk);
      $("#nama").val(nama);
      $("#grade").val(grade);
      $("#pos_name").val(pos_name);
      $("#pbp").val(pbp);
      $("#pensiun").val(pensiun);
      $("#mdg").val(mdg);
      $("#mdj").val(mdj);
      $("#unit_kerja").val(unit_kerja);
      $("#kode_unit_kerja").val(kode_unit_kerja);
      $("#lokasi_kerja").val(lokasi_kerja);
      $("#jenis_usulan").val(jenis_usulan);
      $("#unit_kerja_usulan").val(unit_kerja_usulan);
      $("#grade_usulan").val(grade_usulan);
      $("#jabatan_usulan").val(jabatan_usulan);
      $("#keterangan_usulan").val(keterangan_usulan);
      $("#pengusul").val(pengusul);
      $("#tanggal_usulan").val(tanggal_usulan);
      $("#lokasi_usulan").val(lokasi_usulan);
      $("#id_usulan").val(id_usulan);
      $("#status_usulan").val(status_usulan);
      $("#approver_GM_asal").val(approver_GM_asal);
      $("#tanggal_approve_GM_asal").val(tanggal_approve_GM_asal);
      $("#catatan_GM_asal").val(catatan_GM_asal);
      $("#RP_usulan").val(RP_usulan);
      document.getElementById("form_rmp").submit();
    } else {
      alert("Mohon hanya memilih 1 per approve!");
    }
  });
});
