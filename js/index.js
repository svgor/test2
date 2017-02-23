$(function() {
    var url = "http://test2/php/service.php";
    var db = DevExpress.data.AspNet.createStore({
        key: "ID",
        loadUrl: url,
        insertUrl: url,
        updateUrl: url,
        deleteUrl: url
    });
    $("#gridContainer").dxDataGrid({
        dataSource: { 
            store: db
        },
        height: "100%",
        columns: [{
            dataField: "id",
            dataType: "number",
            allowEditing: false
        }, {
            dataField: "last_name"
        }, {
            dataField: "name"
        }, {
            dataField: "m_name"
        }, {
            dataField: "birthday",
            dataType: "date"
        }],
        groupPanel: {
            visible: true
        },
        sorting: {
            mode: "multiple"
        },
        searchPanel: {
            visible: true
        },
        scrolling: {
            mode: "virtual"
        },
        filterRow: {
            visible: true
        },
        editing: {
            mode: "batch",
            allowAdding: true,
            allowUpdating: true,
            allowDeleting: true
        },
        grouping: {
            autoExpandAll: false
        },
        pager: {
            showPageSizeSelector: true,
            showInfo: true
        },
        summary: {
            totalItems: [{
                column: "id",
                summaryType: "sum"
            },
            {
                column: "id",
                summaryType: "avg"
            }, 
            {
                column: "id",
                summaryType: "min"
            }, {
                column: "id",
                summaryType: "max"
            }],
            groupItems: [{
                summaryType: "count"
            },{
                column: "id",
                summaryType: "min"
            }, {
                column: "id",
                summaryType: "max"}]
            },
            remoteOperations: {
                filtering: true,
                grouping: true,
                groupPaging: true,
                paging: true,
                sorting: true,
                summary: true  
            },
            headerFilter: {
                visible: true
            }
    });
});