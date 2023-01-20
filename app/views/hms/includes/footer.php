<script>
    // SEARCH FILTER
    function filter() {
        let input = document.getElementById("filter").value.toLowerCase();
        let table = document.getElementById("table");
        let tr = table.getElementsByTagName("tr");
        let td;
        let textValue;

        for (let i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];


            if (td) {
                textValue = td.innerHTML;

                if (textValue.toLowerCase().indexOf(input) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }



    // Stop the form re-submit on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>

</html>