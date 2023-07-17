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
        <tr>
            <td><strong>Umzugdatum</strong></td>
            <td>{{ $data['umzugdate'] }}</td>
        </tr>
        <tr>
            <td><strong>Zimmer</strong></td>
            <td>{{ $data['zimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Vorname / Name</strong></td>
            <td>{{ $data['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $data['customerEmail'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['telefon'] }}</td>
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

Unique ID: {{ $data['entryId'] }} <br>
Date: {{ $data['created_at'] }}