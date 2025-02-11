<?php
    $countries = new Country();
    if(isset($code))
        $countries->setRange('Code', $code);
    else
        $countries->FindAll();
?>
<table class='table table-striped'>
    <thead>
        <th>Code</th>
        <th>Nom</th>
        <th>Code ISO</th>
    </thead>
    <tbody>
        <?php
            if($countries->FindSet()){
                foreach ($countries->recordSet as $country) {
                    ?>
                        <tr>
                            <td><?php echo $country->Code->value ?></td>
                            <td><?php echo $country->Name->value ?></td>
                            <td><?php echo $country->IsoCode->value ?></td>
                        </tr>
                    <?php
                }
            }else{
                ?>
                    <p style='font-size: 20px; color: red'> No result found </p>
                <?php
            }
        ?>
    </tbody>
</table>
