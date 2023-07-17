@extends('layouts.app')
@section('header')
@endsection
@section('content')
@if($data['type'] == 'Schnellanfrage')
    <p>Sie haben eine neue Anfrage für einen Umzug erhalten.</p> 

    <p>Im Folgenden finden Sie detaillierte Informationen:</p> 

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
            <td>{{ date('d.m.Y', strtotime($data['umzugdate']));  }}</td>
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
    Sie haben eine neue Anfrage für einen Reinigung erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen:<br>
    <table>
        <tr>
            <td><strong>Adresse (Strasse/PLZ/Ort):</strong></td>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Zimmer / Räume</strong></td>
            <td>{{ $data['anzahlZimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Grösse in m2</strong></td>
            <td>{{ $data['m2'] }}</td>
        </tr>
        <tr>
            <td><strong>Reinigungstermin</strong></td>
            <td>{{ date('d.m.Y', strtotime($data['reinigungTermin']));  }}</td>
        </tr>
        <tr>
            <td><strong>Unternehmen</strong></td>
            <td>{{ $data['unternehmen'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['customerEmail'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['telefon'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'PrivatUmzug')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.:</strong></td>
            <td>{{ $data['vonStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/Ort</strong></td>
            <td>{{ $data['vonPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Zimmer</strong></td>
            <td>{{ $data['anzahlZimmer'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Etage</strong></td>
            <td>{{ $data['vonEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Lift vorhanden?</strong></td>
            <td>{{ $data['ausLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Weitere Dienstleistungen</strong></td>
            <td>{{ $data['weitere'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['nachStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/Ort</strong></td>
            <td>{{ $data['nachPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Etage</strong></td>
            <td>{{ $data['nachEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Umzugsdatum</strong></td>
            <td>{{ date('d.m.Y', strtotime($data['umzugDate']));  }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Lift vorhanden?</strong></td>
            <td>{{ $data['einLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['customerEmail'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Bemerkungen</strong></td>
            <td>{{ $data['bemerkungen'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Firmen')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Von: Str./ Nr.:</strong></td>
            <td>{{ $data['vonStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: PLZ/Ort</strong></td>
            <td>{{ $data['vonPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Anzahl Räume</strong></td>
            <td>{{ $data['anzahlRaume'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Etage</strong></td>
            <td>{{ $data['vonEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Von: Lift vorhanden?</strong></td>
            <td>{{ $data['vonLift'] }}</td>
        </tr>
        
        <tr>
            <td><strong>Nach: Str./ Nr.</strong></td>
            <td>{{ $data['nachStrasse'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: PLZ/Ort</strong></td>
            <td>{{ $data['nachPlzOrt'] }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Etage</strong></td>
            <td>{{ $data['nachEtage'] }}</td>
        </tr>
        <tr>
            <td><strong>Umzugsdatum</strong></td>
            <td>{{ date('d.m.Y', strtotime($data['umzugDate']));  }}</td>
        </tr>
        <tr>
            <td><strong>Nach: Lift vorhanden?</strong></td>
            <td>{{ $data['nachLift'] }}</td>
        </tr>
        <tr>
            <td><strong>Firma</strong></td>
            <td>{{ $data['firma'] }}</td>
        </tr>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Name / Vorname</strong></td>
            <td>{{ $data['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['customerEmail'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Bemerkungen</strong></td>
            <td>{{ $data['bemerkungen'] }}</td>
        </tr>
    </table>
@endif

@if($data['type'] == 'Kontakt')
    Sie haben eine neue Anfrage für einen Umzug erhalten. <br><br>

    Im Folgenden finden Sie detaillierte Informationen: <br>
    <table>
        <tr>
            <td><strong>Anrede</strong></td>
            <td>{{ $data['anrede'] }}</td>
        </tr>
        <tr>
            <td><strong>Vorname / Nachname</strong></td>
            <td>{{ $data['fullname'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre E-Mail-Adresse</strong></td>
            <td>{{ $data['customerEmail'] }}</td>
        </tr>
        <tr>
            <td><strong>Telefon</strong></td>
            <td>{{ $data['telefon'] }}</td>
        </tr>
        <tr>
            <td><strong>Ihre Nachricht</strong></td>
            <td>{{ $data['nachricht'] }}</td>
        </tr>
    </table>
@endif
<br><br>
Unique ID: #{{ $data['entryId'] }} <br>

<?php
$carbonTarih = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['created_at']);

$tarihFormati = $carbonTarih->format('F j, Y'); // "June 22, 2023"
$saatFormati = $carbonTarih->format('h:i a'); // "12:23 pm"

?>
Datum: {{ $tarihFormati }} <br>
Zeit:  {{ $saatFormati }} <br>

<img src="{{ asset('assets/demo/mailFooter.jpg') }}" width="300" alt="umzugspreisvergleich.ch">
@endsection