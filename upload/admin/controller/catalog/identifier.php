<?php
namespace Opencart\Admin\Controller\Catalog;
/**
 * Class Country
 *
 * @package Opencart\Admin\Controller\Catalog
 */
class Identifier extends \Opencart\System\Engine\Controller {
	/**
	 * Index
	 *
	 * @return void
	 */
	public function index(): void {
		$this->load->language('catalog/identifier');

		$this->document->setTitle($this->language->get('heading_title'));

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/identifier', 'user_token=' . $this->session->data['user_token'] . $url)
		];

		$data['add'] = $this->url->link('catalog/identifier.form', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('catalog/identifier.delete', 'user_token=' . $this->session->data['user_token']);

		$data['list'] = $this->getList();

		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/identifier', $data));
	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function list(): void {
		$this->load->language('catalog/identifier');

		$this->response->setOutput($this->getList());
	}

	/**
	 * Get List
	 *
	 * @return string
	 */
	public function getList(): string {
		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['action'] = $this->url->link('catalog/identifier.list', 'user_token=' . $this->session->data['user_token'] . $url);

		// Country
		$data['identifiers'] = [];

		$filter_data = [
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
		];

		$this->load->model('catalog/identifier');

		$results = $this->model_catalog_identifier->getIdentifiers($filter_data);

		foreach ($results as $result) {
			$data['identifiers'][] = ['edit' => $this->url->link('catalog/identifier.form', 'user_token=' . $this->session->data['user_token'] . '&identifier_id=' . $result['identifier_id'] . $url)] + $result;
		}

		$url = '';

		$identifier_total = $this->model_catalog_identifier->getTotalIdentifiers($filter_data);

		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $identifier_total,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('catalog/identifier.list', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($identifier_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($identifier_total - $this->config->get('config_pagination_admin'))) ? $identifier_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $identifier_total, ceil($identifier_total / $this->config->get('config_pagination_admin')));

		return $this->load->view('catalog/identifier_list', $data);
	}

	/**
	 * Form
	 *
	 * @return void
	 */
	public function form(): void {
		$this->load->language('catalog/identifier');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['text_form'] = !isset($this->request->get['identifier_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/identifier', 'user_token=' . $this->session->data['user_token'] . $url)
		];

		$data['save'] = $this->url->link('catalog/identifier.save', 'user_token=' . $this->session->data['user_token']);
		$data['back'] = $this->url->link('catalog/identifier', 'user_token=' . $this->session->data['user_token'] . $url);

		if (isset($this->request->get['identifier_id'])) {
			$this->load->model('catalog/identifier');

			$identifier_id_info = $this->model_catalog_identifier->getIdentifier($this->request->get['identifier_id']);
		}

		if (isset($this->request->get['identifier_id'])) {
			$data['identifier_id'] = (int)$this->request->get['identifier_id'];
		} else {
			$data['identifier_id'] = 0;
		}

		if (!empty($identifier_id_info)) {
			$data['name'] = $identifier_id_info['name'];
		} else {
			$data['name'] = '';
		}

		if (!empty($identifier_id_info)) {
			$data['code'] = $identifier_id_info['code'];
		} else {
			$data['code'] = '';
		}

		if (!empty($identifier_id_info)) {
			$data['status'] = $identifier_id_info['status'];
		} else {
			$data['status'] = 0;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/identifier_form', $data));
	}

	/**
	 * Save
	 *
	 * @return void
	 */
	public function save(): void {
		$this->load->language('catalog/identifier');

		$json = [];

		if (!$this->user->hasPermission('modify', 'catalog/identifier')) {
			$json['error']['warning'] = $this->language->get('error_permission');
		}

		if (!oc_validate_length($this->request->post['name'], 1, 64)) {
			$json['error']['name'] = $this->language->get('error_name');
		}

		if (!oc_validate_length($this->request->post['code'], 3, 48)) {
			$json['error']['code'] = $this->language->get('error_code');
		}

		if (!$json) {
			$this->load->model('catalog/identifier');

			if (!$this->request->post['identifier_id']) {
				$json['identifier_id'] = $this->model_catalog_identifier->addIdentifier($this->request->post);
			} else {
				$this->model_catalog_identifier->editIdentifier($this->request->post['identifier_id'], $this->request->post);
			}

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	/**
	 * Delete
	 *
	 * @return void
	 */
	public function delete(): void {
		$this->load->language('catalog/identifier');

		$json = [];

		if (isset($this->request->post['selected'])) {
			$selected = $this->request->post['selected'];
		} else {
			$selected = [];
		}

		if (!$this->user->hasPermission('modify', 'catalog/identifier')) {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/identifier');
		$this->load->model('catalog/product');

		foreach ($selected as $identifier_id) {
			$identifier_info = $this->model_catalog_identifier->getIdentifier($identifier_id);

			if ($identifier_info) {
				$identifier_total = $this->model_catalog_product->getCodeByCode($identifier_info['code']);

				if ($identifier_total) {
					$json['error'] = sprintf($this->language->get('error_identifier'), $identifier_total);
				}
			}
		}

		if (!$json) {
			$this->load->model('catalog/identifier');

			foreach ($selected as $identifier_id) {
				$this->model_catalog_identifier->deleteIdentifier($identifier_id);
			}

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
