<!DOCTYPE html>
<html>
<head>
    <title>კანდიდატის სრული მონაცემები</title>
</head>
<body>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2 style="text-align: center;">კანდიდატის სრული მონაცემები</h2>
            </td>
            <td class="w-half">
                {{-- <img src="{{ asset('images/background/test.png') }}" alt="" width="200" /> --}}
                <img src="images/background/test.png" alt="" width="200" />
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="rightText">

            </td>
        </tr>
    </table>


{{-- CSS --}}
<style>
    body { font-family: DejaVu Sans, sans-serif; }

    table {
	  /* font-family: arial, sans-serif; */
	  border-collapse: collapse;
	  width: 100%;
	}
	
	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

    .rightText {
        text-align: right;
    }
	
	tr:nth-child(even) {
	  background-color: #dddddd;
	}

    .footer {
        background-color: #dddddd;
        padding: 3%;
    }

    .interested {
        border: solid 1px #1967d2;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        padding: 1%;
        background-color: #1967d2;
        float: right;
    }
</style>

</body>
</html>
