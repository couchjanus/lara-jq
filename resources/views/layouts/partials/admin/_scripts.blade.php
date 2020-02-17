<script src = "{{ asset('js/app.js') }}"> </script>
<script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
<script>
const buttons = [{
        class: "btn btn-info",
        val: "View",
        data: "eye"
    },
    {
        class: "btn btn-primary",
        val: "Edit",
        data: "edit"
    },
    {
        class: "btn btn-danger",
        val: "Delete",
        data: "delete"
    },
];

function makeTable(list, url) {
    let cols = [];

    for (let i = 0; i < list.length; i++) {
        for (let k in list[i]) {
            if (cols.indexOf(k) === -1) {
                cols.push(k);
            }
        }
    }

    let table = document.createElement("table");

    table.classList.add("table", "table-striped", "table-sm");

    let tr = table.insertRow(-1);

    let statusCol = null;

    for (let i = 0; i < cols.length; i++) {
        let theader = document.createElement("th");
        theader.innerHTML = cols[i];
        statusCol = (cols[i] === "status")? i:null;
        
        tr.appendChild(theader);
    }
    
    for (let i = 0; i < list.length; i++) {

        let trow = table.insertRow(-1);

        for (let j = 0; j < cols.length; j++) {
            let cell = trow.insertCell(-1);
            if (j == statusCol) {
                let ch = (list[i][cols[statusCol]] == 1)? 'checked':'';
                cell.innerHTML = "<input data-id="+list[i][cols[0]]+" class='status' type='checkbox' name='switch' " + ch +">";
            } else {
                cell.innerHTML = list[i][cols[j]];
            }
        }

        for (let j = 0; j < 3; j++) {
            let a = document.createElement("a");
            let button = document.createElement("button");
            button.setAttribute('class', buttons[j].class)
            let span = document.createElement("span");
            span.setAttribute('data-feather', buttons[j].data);
            span.innerText = buttons[j].val;
            button.appendChild(span);
            let cell = trow.insertCell(-1);
            a.setAttribute('href', '/api/' + list[i][cols[0]]);
            a.appendChild(button);
            cell.appendChild(a);

        }

    }

    let el = document.getElementById("root");
    el.innerHTML = "";
    el.appendChild(table);
    let currentUrl = document.querySelector(".add");
    currentUrl.setAttribute('url', url);
}

function addCategory(content, action) {
    content.querySelector('form').setAttribute('action', action);
    return content;
}

function addItem(current) {

    let el = document.getElementById("root");

    el.innerHTML = "";

    switch (current) {
        case 'categories':
            let action = '/api/categories';
            const template = document.getElementById('addCategory').content;
            el.append(document.importNode(addCategory(template, action), true));
            break;
        default:
            el.innerHTML = "Add Form" + current;
    }
}

(function () {
    'use strict'

    feather.replace()

    

    $('.users').on('click', function () {
        $.ajax({
                    url: '/api/users',
                    type: 'GET',
                    contentType: "application/json;",
        })
        .then(function (responce) {
            makeTable(responce.data, this.url);
    
            $("[name='switch']").bootstrapSwitch();
    
            $.each($("[name='switch']"), function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked') == true ? true : false);
            });

            $("[name='switch']").on('switchChange.bootstrapSwitch', function (e) {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var user_id = $(this).data('id'); 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/changeStatus',
                    dataType : 'json',
                    type: 'POST',
            
                    data: {
                        status: status, 
                        user_id: user_id,
                        _token: '{{csrf_token()}}'
                    },
                })
                .then(function(data){
                    console.log(data.success)
                });
            });
        });
    });
    
    $('.categories').on('click', function () {
            $.ajax({
                    url: '/api/categories',
                    type: 'GET',
                    contentType: "application/json;",
                })
                .then(function (responce) {
                    makeTable(responce.data, this.url);
                });
    });

    $('.add').on('click', function () {
        let urlStr = document.querySelector('.add').getAttribute('url');
        let segments = urlStr.split('/');
        let current = segments.pop();
        addItem(current);
    });

}());

</script>
