
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<title>Manifiesto</title>
<style>
  table, td, th {
    border: 1px solid black;
  }
  
  table {
    border-collapse: collapse;
    width: 50%;
  }
  
  th {
    
    text-align: left;
  }
  </style>
</head>

<body>
 
 <?php 
    
  
  
  ?>
 
<table style="width: 100%;">
  <tr>
    <th style="text-align: center;">PAQUETE</th>
    <th style="text-align: center; ">AGENTE</th>
    <th style="text-align: center; ">OFICINA_ORIGEN</th>
    <th style="text-align: center; ">OFICINA_RECIBE</th>
    <th style="text-align: center; ">ENVIO</th>
    <th style="text-align: center; ">FECHA</th>
    <th style="text-align: center; ">DESTINATARIO</th>
    <th style="text-align: center; ">DESCRIPCIÓN</th>
    <th style="text-align: center; ">USD</th>
    <th style="text-align: center; ">PZS</th>
    <th style="text-align: center; ">UNID</th>
    <th style="text-align: center; ">PESO</th>
    <th style="text-align: center; ">PC</th>
    <th style="text-align: center; ">M3</th>
    <th style="text-align: center; ">DIRECCIÓN</th>
    <th style="text-align: center; ">TELEF</th>
    <th style="text-align: center; ">SHIPPER</th>
    <th style="text-align: center; ">PO</th>
    <th style="text-align: center; ">INV</th>
    <th style="text-align: center; ">PAGAR</th>
    <th style="text-align: center; ">TRACKING</th>
  </tr>
    @foreach ($packages as $package)
        <tr>
          <td style="text-align: center; font-weight: normal;">{{ $package->numero_paquete }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->agent_name }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->name }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->ag_name }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->instruction }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->arrival_date }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->client_name }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->description }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->total_usd }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->count_package_lumps }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->description_type }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->bulk_weight }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->length_weight }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->length_weight }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->client_direction }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->client_phone }}</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->name_shipper }}</td>
          <td style="text-align: center; font-weight: normal;">N/A</td>
          <td style="text-align: center; font-weight: normal;">N/A</td>
          <td style="text-align: center; font-weight: normal;">N/A</td>
          <td style="text-align: center; font-weight: normal;">{{ $package->tracking }}</td>
        </tr>
      @endforeach
  
</table>

</body>
</html>