<h1>Offer Mail Test</h1>
@if($data['type'] == 'Schnellanfrage')
<h3>Schnellan</h3>
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.</strong></td>
            <td>{{ $data['von1'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/ Ort</strong></td>
            <td>{{ $data['von2'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['nach1'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/ Ort</strong></td>
            <td>{{ $data['nach2'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Reinigung')
<h3>Reinigung</h3>
    <table>
        <tr>
            <td><strong>Address</strong></td>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <td><strong>Zimmer</strong></td>
            <td>{{ $data['anzahlZimmer'] }}</td>
        </tr>
    </table>
@endif