<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
@page {
    size: A4 landscape;
    margin: 30px;
}

body {
    font-family: DejaVu Sans, sans-serif;
}

/* OUTER BOX (CENTER CONTROL) */
.wrapper {
    width: 100%;
    text-align: center;
}

/* MAIN CERTIFICATE BOX */
.certificate {
    width: 80%;              /* 👈 width control */
    margin: 0 auto;          /* 👈 center */
    border: 8px solid #6366f1;
    padding: 15px;
}

/* INNER BORDER */
.inner {
    border: 3px solid #ec4899;
    padding: 40px 30px;
}

/* TEXT STYLING */
h1 {
    font-size: 36px;
    margin-bottom: 10px;
    color: #6366f1;
}

.name {
    font-size: 30px;
    color: #8b5cf6;
    font-weight: bold;
    margin: 10px 0;
}

.quiz {
    font-size: 22px;
    color: #ec4899;
    margin: 10px 0;
}

p {
    font-size: 16px;
    margin: 6px 0;
}

/* FOOTER */
.footer {
    margin-top: 60px;
    width: 100%;
}

.footer table {
    width: 100%;
}

.line {
    border-top: 1px solid black;
    width: 200px;
    margin: 0 auto;
    margin-top: 40px;
}

</style>
</head>

<body>

<div class="wrapper">

    <div class="certificate">
        <div class="inner">

            <h1>Certificate of Completion</h1>

            <p>This is to certify that</p>

            <div class="name">{{ $data['userName'] }}</div>

            <p>has successfully completed the quiz</p>

            <div class="quiz">{{ $data['quizName'] }}</div>

            <p>with a score of <b>100%</b></p>

            <p>Completed on</p>

            <p><b>{{ date('F d, Y') }}</b></p>

            <!-- SIGNATURE -->
            <div class="footer">
                <table>
                    <tr>
                        <td align="center">
                            <div class="line"></div>
                            <p>Signature</p>
                        </td>

                        <td align="center">
                            <div class="line"></div>
                            <p>Administrator</p>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>
<a href='/download-certificate'>Download Certificate</a>
</body>
</html>
