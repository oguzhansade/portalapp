<h1>Offer Mail Test</h1>
@if($data['type'] == 'Schenllanfrage')
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.</strong></td>
            <td>{{ $data['von1'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/ Ort</strong></td>
            <td>{{ $data['von2'] }}</td>
        </tr>
    </table>
@endif