<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<title>Factura</title>
<style>
  table, td, th {
    border: 1px solid black;
  }
  
  table {
    border-collapse: collapse;
    width: 100%;
  }
  
  th {
    
    text-align: left;
  }

  #g-table tbody tr > td{
                    border: solid rgb(220,220,220);
                    height: 30px;
                }
    #g-table{
        padding-left: 40px;
        margin-top: 20px;

    }
    
    .saltopagina{page-break-after:always;}
   
  </style>
</head>

<body>

  @isset($package_lumps)
    @php
        $primera_pagina = false;
    @endphp
    
    @foreach ($package_lumps as $package_lump)
          
      @if ($primera_pagina == true)
        <div clas='saltopagina'>
      @endif

      <br>
      <table>
        <tr>
          <th style="text-align: left; font-weight: normal; width: 50%; border-color: white; font-weight: bold;"> <img src="{{ asset('img/northdelivery.jpg') }}" width="80%"  class="d-inline-block align-top" alt=""></th>
          <th style="text-align: left; font-weight: normal; width: 50%; border-color: white; font-weight: bold;"><h3>{{$general->direction2 ?? ''}}  </h3><br><h3>{{$general->phone ?? ''}}  </h3></th>
        </tr> 
      </table>
      <table>
        <tr>
          <th style="text-align: left; font-weight: normal; width: 50%; border-color: white; font-weight: bold;">_______________________________________________________________________________</th>
        </tr> 
      </table>
      <table>
        <tr>
          <td style="text-align: left;  width: 50%; border-color: white; "> <h2>Shipper: {{$package->shippers['name'] ?? ''}}</h2></th>
        </tr> 
        <tr>
          <th style="text-align: left; font-weight: normal; width: 50%; border-color: white; font-weight: bold;">_______________________________________________________________________________</th>
        </tr> 
      </table>
      <table>
        <tr>
          <td style="text-align: left;  width: 50%; border-color: white; "> <h3>Consignee: {{$package->clients['firstname'] ?? ''}} {{$package->clients['secondname'] ?? ''}} {{$package->clients['firstlastname'] ?? ''}} {{$package->clients['secondlastname'] ?? ''}}   
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
            {{$package->clients->countries['abbreviation'] ?? ''}}{{str_pad($package->clients['id'] ?? 0, 6, "0", STR_PAD_LEFT)}}</h3></th>
        </tr> 
      </table>

      <table >
        <tr>
          <td style="text-align: left;  width: 50%; border-color: white; ">{{$package->clients['street_received'] ?? ''}}  </td>
        </tr> 
        <tr>
          <td style="text-align: left;  width: 50%; border-color: white; ">{{$package->clients['urbanization_received'] ?? ''}}   </td>
        </tr> 
        <tr>
          <td style="text-align: left;  width: 50%; border-color: white; ">{{$package->clients['direction'] ?? ''}} - {{$package->clients->states->countries['name'] ?? ''}}  </td>
        </tr> 
      </table>
      <table>
        <tr>
          <th style="text-align: left;  width: 50%; border-color: white; ">   <h2>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
            Weight Charge:
          </h2>
          </th>
          </tr> 
          <tr>
            <th style="text-align: left; font-weight: normal;  border-color: white;">_______________________________________________________________________________</th>
          </tr> 
      </table>
      @php
          $volume = ceil(($package_lump->length_weight * $package_lump->width_weight * $package_lump->high_weight) / 166);
          $cubic_foot = ceil(($package_lump->length_weight * $package_lump->width_weight * $package_lump->high_weight) / 1728);
      @endphp
      <table >
        <tr>
          <th style="text-align: left;  width: 25%; border-color: white; ">Weight</th>
          <th style="text-align: left;  width: 25%; border-color: white; ">Dimensions (Inches)</th>
          <th style="text-align: left;  width: 25%; border-color: white; ">PVolume</th>
          <th style="text-align: left;  width: 25%; border-color: white; ">Cubic Foot</th>
        </tr> 
        <tr>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$package_lump->bulk_weight}} Lbs/Kg</td>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$package_lump->length_weight}} x {{$package_lump->width_weight}} x {{$package_lump->high_weight}}</td>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$volume}} Lbs/Kg</td>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$cubic_foot}} ft3</td>
        </tr> 
      </table>
      <h1 style="text-align: center; font-size: 80px;">{{str_pad($package->id ?? 0, 5, "0", STR_PAD_LEFT)}}</h1>
   
      <table >
        <tr>
          <th style="text-align: left;  width: 25%; border-color: white; ">Destination</th>
          <th style="text-align: left;  width: 25%; border-color: white; ">Agent</th>
        </tr> 
        <tr>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$package->destination_countries['abbreviation'] ?? ''}}</td>
          <td style="text-align: left;  width: 25%; border-color: white; ">{{$package->vendors['name'] ?? ''}}</td>
        </tr> 
      </table>
      <table >
          <tr>
            <th style="text-align: left; font-weight: normal;  border-color: white;">_______________________________________________________________________________</th>
          </tr> 
      </table>
      <table >
        <tr>
          <th style="text-align: left;  width: 75%; border-color: white; ">Service</th>
          <th style="text-align: left;  width: 25%; border-color: white; ">{{ $datenow ?? '' }}</th>
        </tr> 
      </table>

      <h1 style="text-align: left; font-size: 40px;">{{ $package->instruction ?? ''}}</h1>
      <div style="font-size: 20px; padding:0 17rem;">Tracking: {{ $package->tracking ?? ''}} </div>
      </br>
      <div style="padding:0 14rem; ">{!! DNS1D::getBarcodeHTML($package->tracking, 'QRCODE') !!}</div>

      @php
          $primera_pagina = true;
      @endphp
    @endforeach
    
      
  @endisset
</body>
</html>
