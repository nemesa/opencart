{{ header }}
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">{{ column_left }}
    {% if column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="{{ class }}">{{ content_top }}
      <h1>{{ heading_title }}</h1>
      {% if returns) { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-right">{{ column_return_id; }}</td>
              <td class="text-left">{{ column_status; }}</td>
              <td class="text-left">{{ column_date_added; }}</td>
              <td class="text-right">{{ column_order_id; }}</td>
              <td class="text-left">{{ column_customer; }}</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($returns as $return) { ?>
            <tr>
              <td class="text-right">#<?php echo $return['return_id']; ?></td>
              <td class="text-left"><?php echo $return['status']; ?></td>
              <td class="text-left"><?php echo $return['date_added']; ?></td>
              <td class="text-right"><?php echo $return['order_id']; ?></td>
              <td class="text-left"><?php echo $return['name']; ?></td>
              <td class="text-right"><a href="<?php echo $return['href']; ?>" data-toggle="tooltip" title="{{ button_view }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-sm-6 text-left">{{ pagination }}</div>
        <div class="col-sm-6 text-right">{{ results }}</div>
      </div>
      <?php } else { ?>
      <p>{{ text_empty }}</p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="{{ continue }}" class="btn btn-primary">{{ button_continue }}</a></div>
      </div>
      {{ content_bottom }}</div>
    {{ column_right }}</div>
</div>
{{ footer }}
