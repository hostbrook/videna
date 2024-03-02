<?php if ($log) : ?>
    <?php foreach ($log as $line) : ?>
    <?php
        preg_match('/^\[(.*)\] (.*)$/Uism', $line, $match);

        if (!empty($match)) {
            $datetime = '[<span class="uk-text-success">' . $match[1] . '</span>]';

            $recordType = $match[2];
            $level = ' <span class="uk-text-primary">' . $recordType . '</span>';

            preg_match('/.*(?:'.FATAL.'|'.EMERGENCY.'|'.ERROR.'|'.CRITICAL.').*/ism', $recordType, $match);
            if (!empty($match)) $level = ' <span class="uk-text-danger">' . $recordType . '</span>';

            preg_match('/.*(?:'.ALERT.'|'.WARNING.'|'.NOTICE.').*/ism', $recordType, $match);
            if (!empty($match)) $level = ' <span class="uk-text-warning">' . $recordType . '</span>';

            $line = '<span class="uk-text-muted">' . $datetime . $level . '</span>';
        }
        else {
            preg_match('/^Stack trace(.*)$/Uism', $line, $match);

            if ( !empty($match) )  {
                $line = '<span class="uk-text-muted">' . $match[0] . '</span>';
            }
            else {
                preg_match('/^#\d .*$/Uism', $line, $match);
                if ( !empty($match) )  {
                    $line = '<span class="uk-text-muted">' . $match[0] . '</span>';
                }
                else {
                    $line = '<span class="uk-text-secondary">' . $line . '</span>';
                }
            }
        }
    ?>
    <code class="uk-text-small"><?= $line ?></code><br>
    <?php endforeach; ?>
<?php else : ?>
    <p class="uk-text-success">Log file not found.</p>
<?php endif; ?>