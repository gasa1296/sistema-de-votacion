<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: sans-serif; padding: 20px;">
    <h1 style="color: #1a1a1a;">Resultados — {{ $election->name }}</h1>
    <p><strong>Estado:</strong> {{ $election->status }}</p>
    <p><strong>Total de votos:</strong> {{ $election->votes_count }}</p>
    <p><strong>Generado:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f5f5f5;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Candidato</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Cargo</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">IP Hash</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Fecha Voto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $row)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $row['candidate'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $row['position'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $row['ip_hash'] ?? 'N/A' }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $row['voted_at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
