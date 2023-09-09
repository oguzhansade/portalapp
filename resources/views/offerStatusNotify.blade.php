{{ $data['offer']['fullname'] }} für Angebot Nr. {{ $data['offer']['id'] }}
<h3>Angebot @if($data['canceled'] == 0) genehmigt @elseif($data['canceled'] == 1) abgelehnt @endif</h3>



<h4>Angebotsdetails</h4>
@if($data['type'] == 'Schnellanfrage')
    <p>Sie haben eine neue Anfrage für einen Umzug erhalten.</p> 

    <p>Im Folgenden finden Sie detaillierte Informationen:</p> 

    <table>
        <tr>
            <td><strong>Von: Str./ Nr.</strong></td>
            <td>{{ $data['offer']['von1'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/ Ort</strong></td>
            <td>{{ $data['offer']['von2'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['offer']['nach1'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/ Ort</strong></td>
            <td>{{ $data['offer']['nach2'] }}</td>
        </tr>
        <tr>
            <td><strong>Umzugdatum</strong></td>
            <td>@if($data['offer']['umzugdate']){{ date('d.m.Y', strtotime($data['offer']['umzugdate']));  }} @else - @endif</td>
        </tr>
        <tr>
            <td><strong>Zimmer</strong></td>
            <td>{{ $data['offer']['zimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Vorname / Name</strong></td>
            <td>{{ $data['offer']['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $data['offer']['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['offer']['telefon'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Reinigung')
    Sie haben eine neue Anfrage für einen Reinigung erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen:<br>
    <table>
        <tr>
            <td><strong>Adresse (Strasse/PLZ/Ort):</strong></td>
            <td>{{ $data['offer']['address'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Zimmer / Räume</strong></td>
            <td>{{ $data['offer']['anzahlZimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Grösse in m2</strong></td>
            <td>{{ $data['offer']['m2'] }}</td>
        </tr>
        <tr>
            <td><strong>Reinigungstermin</strong></td>
            <td>@if($data['offer']['reinigungTermin']){{ date('d.m.Y', strtotime($data['offer']['reinigungTermin']));  }} @else - @endif</td>
        </tr>
        <tr>
            <td><strong>Unternehmen</strong></td>
            <td>{{ $data['offer']['unternehmen'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['offer']['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['offer']['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['offer']['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['offer']['telefon'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'PrivatUmzug')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.:</strong></td>
            <td>{{ $data['offer']['vonStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/Ort</strong></td>
            <td>{{ $data['offer']['vonPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Zimmer</strong></td>
            <td>{{ $data['offer']['anzahlZimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Etage</strong></td>
            <td>{{ $data['offer']['vonEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Lift vorhanden?</strong></td>
            <td>{{ $data['offer']['ausLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Weitere Dienstleistungen</strong></td>
            <td>{{ $data['offer']['weitere'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['offer']['nachStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/Ort</strong></td>
            <td>{{ $data['offer']['nachPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Etage</strong></td>
            <td>{{ $data['offer']['nachEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Umzugsdatum</strong></td>
            <td>@if($data['offer']['umzugDate']){{ date('d.m.Y', strtotime($data['offer']['umzugDate']));  }} @else - @endif</td>
        </tr>
        <tr>
            <td><strong>Nach: Lift vorhanden?</strong></td>
            <td>{{ $data['offer']['einLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['offer']['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['offer']['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['offer']['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['offer']['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Bemerkungen</strong></td>
            <td>{{ $data['offer']['bemerkungen'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Firmen')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.:</strong></td>
            <td>{{ $data['offer']['vonStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/Ort</strong></td>
            <td>{{ $data['offer']['vonPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Räume</strong></td>
            <td>{{ $data['offer']['anzahlRaume'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Etage</strong></td>
            <td>{{ $data['offer']['vonEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Lift vorhanden?</strong></td>
            <td>{{ $data['offer']['vonLift'] }}</td>
        </tr>
        
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['offer']['nachStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/Ort</strong></td>
            <td>{{ $data['offer']['nachPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Etage</strong></td>
            <td>{{ $data['offer']['nachEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Umzugsdatum</strong></td>
            <td>@if($data['offer']['umzugDate']){{ date('d.m.Y', strtotime($data['offer']['umzugDate']));  }} @else - @endif</td>
        </tr>
        <tr>
            <td><strong>Nach: Lift vorhanden?</strong></td>
            <td>{{ $data['offer']['nachLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Firma</strong></td>
            <td>{{ $data['offer']['firma'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['offer']['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['offer']['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['offer']['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['offer']['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Bemerkungen</strong></td>
            <td>{{ $data['offer']['bemerkungen'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Kontakt')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['offer']['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Vorname / Nachname</strong></td>
            <td>{{ $data['offer']['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['offer']['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['offer']['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre Nachricht</strong></td>
            <td>{{ $data['offer']['nachricht'] }}</td>
        </tr>
    </table>
@endif
<br><br>
Unique ID: #{{ $data['offer']['entryId'] }} <br>

<?php
$carbonTarih = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['offer']['created_at']);

$tarihFormati = $carbonTarih->format('F j, Y'); // "June 22, 2023"
$saatFormati = $carbonTarih->format('h:i a'); // "12:23 pm"

?>
Datum: {{ $tarihFormati }} <br>
Zeit:  {{ $saatFormati }} <br>

<img src="{{ asset('assets/demo/mailFooter.jpg') }}" width="300" alt="umzugspreisvergleich.ch">

