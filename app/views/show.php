<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Users Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        :root {
            --primary-green: #15803d;
            --dark-green: #14532d;
            --light-green: #dcfce7;
            --soft-green: #f0fdf4;
            --accent-green: #22c55e;
            --border-color: #e5e7eb;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, #dcfce7 0%, transparent 35%),
                #f7faf8;
            color: var(--text-dark);
            padding: 35px;
        }

        .page-wrapper {
            max-width: 1250px;
            margin: 0 auto;
        }

        /* =========================
       TOP SECTION
    ========================= */

        .page-header {
            background: linear-gradient(135deg, var(--dark-green), var(--primary-green));
            border-radius: 22px;
            padding: 32px;
            color: white;
            margin-bottom: 25px;
            box-shadow: 0 15px 35px rgba(21, 128, 61, 0.18);
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            right: -70px;
            top: -90px;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header-content h1 {
            font-size: 30px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .header-content p {
            font-size: 14px;
            opacity: 0.85;
        }

        /* =========================
       MAIN CONTENT
    ========================= */

        .dashboard-card {
            background: var(--white);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(22, 163, 74, 0.08);
        }

        /* =========================
       TOOLBAR
    ========================= */

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--border-color);
        }

        .toolbar-title h2 {
            font-size: 20px;
            color: var(--dark-green);
            margin-bottom: 5px;
        }

        .toolbar-title span {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* =========================
       SEARCH
    ========================= */

        .search-box {
            position: relative;
            width: 340px;
        }

        .search-box input {
            width: 100%;
            height: 46px;
            padding: 0 18px 0 46px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            background: #fafafa;
            outline: none;
            font-size: 14px;
            transition: 0.25s ease;
        }

        .search-box input:focus {
            border-color: var(--accent-green);
            background: white;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.12);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: var(--primary-green);
            pointer-events: none;
        }

        /* =========================
       TABLE AREA
    ========================= */

        .table-wrapper {
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        thead {
            background: var(--soft-green);
        }

        th {
            text-align: left;
            padding: 17px 18px;
            font-size: 12px;
            font-weight: 700;
            color: var(--dark-green);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #d1fae5;
        }

        td {
            padding: 18px;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
            color: #374151;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f7fef9;
        }

        tbody tr:hover td:first-child {
            color: var(--primary-green);
            font-weight: 700;
        }

        /* =========================
       ID STYLE
    ========================= */

        td:first-child {
            font-weight: 600;
            color: var(--primary-green);
        }

        /* =========================
       PAGINATION
    ========================= */

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .pagination-info {
            margin-right: auto;
            font-size: 13px;
            color: var(--text-muted);
            background: var(--soft-green);
            padding: 10px 14px;
            border-radius: 10px;
        }

        .pagination button {
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: white;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination button:hover:not(:disabled) {
            border-color: var(--accent-green);
            color: var(--primary-green);
            background: var(--soft-green);
        }

        .pagination button.active {
            background: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
            box-shadow: 0 5px 12px rgba(21, 128, 61, 0.22);
        }

        .pagination button:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        #pageNumbers {
            display: flex;
            gap: 7px;
        }

        /* =========================
       RESPONSIVE
    ========================= */

        @media (max-width: 900px) {
            body {
                padding: 20px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .page-header {
                padding: 25px;
                border-radius: 18px;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .dashboard-card {
                padding: 18px;
                border-radius: 18px;
            }

            .pagination {
                justify-content: center;
            }

            .pagination-info {
                width: 100%;
                margin-right: 0;
                text-align: center;
            }

            #pageNumbers {
                order: 3;
            }
        }
    </style>


</head>

<body>


    <div class="page-wrapper">

        <!-- =========================
         PAGE HEADER
    ========================= -->

        <section class="page-header">

            <div class="header-content">
                <h1>User Management</h1>

                <p>
                    View, search, and manage registered users in the system.
                </p>
            </div>

        </section>


        <!-- =========================
         MAIN DASHBOARD CARD
    ========================= -->

        <main class="dashboard-card">

            <!-- TOOLBAR -->

            <div class="toolbar">

                <div class="toolbar-title">
                    <h2>Registered Users</h2>
                    <span>User directory and account information</span>
                </div>


                <!-- SEARCH -->

                <div class="search-box">

                    <span class="search-icon">🔍</span>

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search users..."
                        onkeyup="searchEmployee()">

                </div>

            </div>


            <!-- =========================
             USERS TABLE
        ========================= -->

            <div class="table-wrapper">

                <table id="employeeTable">

                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Username</th>
                        </tr>
                    </thead>


                    <tbody>

                        <?php foreach ($users as $user): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($user['id']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($user['firstname']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($user['lastname']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($user['email']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($user['username']); ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


            <!-- =========================
             PAGINATION
        ========================= -->

            <div class="pagination">

                <div
                    class="pagination-info"
                    id="paginationInfo">
                </div>


                <button
                    type="button"
                    id="prevPage"
                    onclick="changePage(-1)">

                    Previous

                </button>


                <div id="pageNumbers"></div>


                <button
                    type="button"
                    id="nextPage"
                    onclick="changePage(1)">

                    Next

                </button>

            </div>

        </main>

    </div>


    <!-- =========================
     SEARCH + PAGINATION SCRIPT
     ORIGINAL LOGIC PRESERVED
========================= -->

    <script>
        const rowsPerPage = 5;

        let currentPage = 1;


        /* =========================
           GET FILTERED ROWS
        ========================= */

        function getFilteredRows() {

            let input = document
                .getElementById("searchInput")
                .value
                .toLowerCase()
                .trim();


            let rows = Array.from(
                document.querySelectorAll(
                    "#employeeTable tbody tr"
                )
            );


            return rows.filter(row => {

                return row.innerText
                    .toLowerCase()
                    .includes(input);

            });

        }


        /* =========================
           DISPLAY TABLE
        ========================= */

        function displayTable() {

            let allRows = Array.from(
                document.querySelectorAll(
                    "#employeeTable tbody tr"
                )
            );


            let filteredRows =
                getFilteredRows();


            let totalPages = Math.max(
                1,
                Math.ceil(
                    filteredRows.length /
                    rowsPerPage
                )
            );


            if (currentPage > totalPages) {

                currentPage = totalPages;

            }


            /* HIDE ALL ROWS */

            allRows.forEach(row => {

                row.style.display = "none";

            });


            /* CALCULATE ROWS */

            let start =
                (currentPage - 1) *
                rowsPerPage;


            let end =
                start +
                rowsPerPage;


            /* SHOW CURRENT PAGE */

            filteredRows
                .slice(start, end)
                .forEach(row => {

                    row.style.display = "";

                });


            renderPagination(
                totalPages,
                filteredRows.length
            );

        }


        /* =========================
           RENDER PAGINATION
        ========================= */

        function renderPagination(
            totalPages,
            totalRows
        ) {

            let pageNumbers =
                document.getElementById(
                    "pageNumbers"
                );


            let paginationInfo =
                document.getElementById(
                    "paginationInfo"
                );


            let prevPage =
                document.getElementById(
                    "prevPage"
                );


            let nextPage =
                document.getElementById(
                    "nextPage"
                );


            pageNumbers.innerHTML = "";


            /* NO EMPLOYEES */

            if (totalRows === 0) {

                paginationInfo.textContent =
                    "No employees found";

            }


            /* EMPLOYEES EXIST */
            else {

                let start =
                    (currentPage - 1) *
                    rowsPerPage + 1;


                let end =
                    Math.min(
                        currentPage *
                        rowsPerPage,
                        totalRows
                    );


                paginationInfo.textContent =
                    `Showing ${start}-${end} of ${totalRows}`;

            }


            /* PREVIOUS BUTTON */

            prevPage.disabled =
                currentPage === 1;


            /* NEXT BUTTON */

            nextPage.disabled =
                currentPage === totalPages;


            /* PAGE NUMBERS */

            for (
                let i = 1; i <= totalPages; i++
            ) {

                let button =
                    document.createElement(
                        "button"
                    );


                button.type = "button";

                button.textContent = i;


                if (i === currentPage) {

                    button.classList.add(
                        "active"
                    );

                }


                button.onclick = function() {

                    currentPage = i;

                    displayTable();

                };


                pageNumbers.appendChild(
                    button
                );

            }

        }


        /* =========================
           CHANGE PAGE
        ========================= */

        function changePage(direction) {

            let filteredRows =
                getFilteredRows();


            let totalPages =
                Math.max(
                    1,
                    Math.ceil(
                        filteredRows.length /
                        rowsPerPage
                    )
                );


            currentPage += direction;


            if (currentPage < 1) {

                currentPage = 1;

            }


            if (currentPage > totalPages) {

                currentPage = totalPages;

            }


            displayTable();

        }


        /* =========================
           SEARCH
        ========================= */

        function searchEmployee() {

            currentPage = 1;

            displayTable();

        }


        /* =========================
           INITIAL LOAD
        ========================= */

        displayTable();
    </script>


</body>

</html>