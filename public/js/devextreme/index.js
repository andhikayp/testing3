
$(function(){
    var dataGrid = $("#grid-container").dxDataGrid({
        dataSource: sales,
        columnAutoWidth: true,
        keyExpr: "nama",
        showBorders: true,
        selection: {
            mode: "multiple"
        },
        paging: {
            pageSize: 10
        },
        filterRow: { 
            visible: true
        },
        columns: [{ 
                dataField: "nama", 
                caption: "Nama"
            },{ 
                dataField: "npk_lama", 
                caption: "NPK"
            },{ 
                dataField: "grade", 
                caption: "Grade"
            },{ 
                dataField: "pos_name", 
                caption: "Jabatan"
            },{ 
                dataField: "PBP", 
                caption: "Tanggal PBP"
            },{ 
                dataField: "pensiun", 
                caption: "Tanggal Pensiun"
            },{ 
                dataField: "MDG", 
                caption: "MDG"
            },{ 
                dataField: "MDJ", 
                caption: "MDJ"
            },{ 
                //dataField: "nama", 
                caption: "Status Usulan"
            },]
    }).dxDataGrid("instance");
    
    $("#select-all-mode").dxSelectBox({
        dataSource: ["allPages", "page"],
        value: "allPages",
        onValueChanged: function (data) {
            dataGrid.option("selection.selectAllMode", data.value);
        }
    });
    
    $("#show-checkboxes-mode").dxSelectBox({
        dataSource: ["none", "onClick", "onLongTap", "always"],
        value: "always",
        onValueChanged: function (data) {
            dataGrid.option("selection.showCheckBoxesMode", data.value);
            $("#select-all-mode").dxSelectBox("instance").option("disabled", data.value === "none");
        }
    });
});