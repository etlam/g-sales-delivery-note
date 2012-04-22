<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>g*Sales 2 - <?=$prefix;?><?=$data->base->id + $offset;?></title>
<link rel="stylesheet" type="text/css" href="../lib/js/jquery-ui/css/default/jquery-ui-1.8.13.custom.css" />
<link rel="stylesheet" type="text/css" href="../lib/css/screen.css" />
<!--[if IE]><link rel="stylesheet" type="text/css" href="../lib/css/ie.css" /><![endif]-->
<style>
body {
	background: #FFF;
}
#invoice {
	width: 760px;
	padding: 20px;
}
input[type="text"] {
	font-size: inherit;
	font-family: inherit;
	width: 100px;
}
</style>
</head>

<body>
<div id="invoice">
  <form action="index.php?iid=<?=$data->base->id;?>" method="post">
    <div style="float:left; width:250px;"> <strong>Knd.-Nr.:</strong>
      <?=$data->base->customerno;?>
      <a title="Rechnung ist mit dem Kunde <?=$data->base->customerno;?> verknüpft." href="../customer/index.php?p=showcustomer&amp;cid=<?=$data->base->customers_id;?>" target="_parent"><img style="margin-bottom: -3px;" alt="zum verknüfpten Kunden" src="../lib/img/icon_link.png"></a><br>
      <br>
      <?=nl2br($data->base->recipient_txt);?>
      <br>
    </div>
    <table style="float:right; width: 220px; line-height: 1.5em; border-collapse: collapse;">
      <tbody>
        <tr>
          <th>Lieferschein Nr.:</th>
          <td><?=$prefix;?><?=$data->base->id + $offset;?></td>
        </tr>
        <tr>
          <th>Lieferdatum:</th>
          <td><input name="date" type="text" value="<?=date('d.m.Y', time());?>" /></td>
        </tr>
        <tr>
          <th>Form:</th>
          <td><select name="dlvry-form"><option>Briefpapier</option><option<?=($blanko_by_default ? ' selected' : '');?>>Blanko</option></select></td>
        </tr>
      </tbody>
    </table>
    <br class="clear">
    <br>
    <p> <strong>Einleitungstext</strong><br>
      <textarea name="einleitung" cols="" rows="" style="width: 100%; height: 50px;"><?=$einleitungstext; ?></textarea>
    </p>
    <div class="docTableHead ui-helper-clearfix">
      <div style="width:345px;">&nbsp;</div>
    </div>
    <ul id="myList" class="ui-sortable">
      <? foreach ($data->pos as $position) : ?>
      <li id="pos_<?=$position->id;?>">
        <div class="docTableBody ui-helper-clearfix">
          <div class="center" style="width:25px;">
            <input type="checkbox" name="print_<?=$position->id;?>" checked />
          </div>
          <div style="width:60px;">
            <?=$position->quantity;?>
            <?=$position->unit;?>
          </div>
          <div style="width:250px;">
            <?=nl2br($position->vars_pos_txt);?>
          </div>
        </div>
      </li>
      <? endforeach; ?>
    </ul>
    <p> <br>
      <strong>Abschlusstext</strong><br>
      <textarea name="abschlusstext" cols="" rows="" style="width: 100%; height: 50px;"><?=$abschlusstext; ?></textarea>
    </p>
    <input name="print" type="submit" value="Lieferschein erstellen" />
  </form>
</div>
</body>
</html>