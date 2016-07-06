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
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-left" colspan="2">{{ text_return_detail }}</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left" style="width: 50%;"><b>{{ text_return_id; ?></b> #<?php echo $return_id }}<br />
              <b>{{ text_date_added; ?></b> <?php echo $date_added }}</td>
            <td class="text-left" style="width: 50%;"><b>{{ text_order_id; ?></b> #<?php echo $order_id }}<br />
              <b>{{ text_date_ordered; ?></b> <?php echo $date_ordered }}</td>
          </tr>
        </tbody>
      </table>
      <h3>{{ text_product }}</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left" style="width: 33.3%;">{{ column_product; }}</td>
              <td class="text-left" style="width: 33.3%;">{{ column_model; }}</td>
              <td class="text-right" style="width: 33.3%;">{{ column_quantity; }}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-left">{{ product }}</td>
              <td class="text-left">{{ model }}</td>
              <td class="text-right">{{ quantity }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <h3>{{ text_reason }}</h3>
      <div class="table-responsive">
        <table class="list table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left" style="width: 33.3%;">{{ column_reason; }}</td>
              <td class="text-left" style="width: 33.3%;">{{ column_opened; }}</td>
              <td class="text-left" style="width: 33.3%;">{{ column_action; }}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-left">{{ reason }}</td>
              <td class="text-left">{{ opened }}</td>
              <td class="text-left">{{ action }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      {% if comment) { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left">{{ text_comment }}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-left">{{ comment }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php } ?>
      <h3>{{ text_history }}</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left" style="width: 33.3%;">{{ column_date_added; }}</td>
              <td class="text-left" style="width: 33.3%;">{{ column_status; }}</td>
              <td class="text-left" style="width: 33.3%;">{{ column_comment; }}</td>
            </tr>
          </thead>
          <tbody>
            {% if histories) { ?>
            <?php foreach ($histories as $history) { ?>
            <tr>
              <td class="text-left"><?php echo $history['date_added']; ?></td>
              <td class="text-left"><?php echo $history['status']; ?></td>
              <td class="text-left"><?php echo $history['comment']; ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td colspan="3" class="text-center">{{ text_no_results }}</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="{{ continue }}" class="btn btn-primary">{{ button_continue }}</a></div>
      </div>
      {{ content_bottom }}</div>
    {{ column_right }}</div>
</div>
{{ footer }}
