<thead>
    <tr>
        <td width="4%">L.p.</td>
        <td width="25%">Nazwisko i imię</td>
        <td>Miejsce zatrudnienia</td>
        <? foreach ($model->lessonsDateAsc as $lesson): ?>
            <td width="9%">
                <input type="hidden" name="lessonPresenceToDelete[]" value="<?= $lesson->id ?>"/>
                <?= date('d.m.Y', strtotime($lesson->date_start)) ?>
            </td>
        <? endforeach ?>
    </tr>
</thead>
