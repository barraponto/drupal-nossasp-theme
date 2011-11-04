<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to nossasp_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: nossasp_breadcrumb()
 *
 *   where nossasp is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function nossasp_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function nossasp_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function nossasp_preprocess_page(&$vars, $hook) {
  drupal_set_html_head('<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">');
  $vars['head'] = drupal_get_html_head();

  $vars['rede_logo'] = l('Rede Nossa São Paulo', 'http://www.nossasaopaulo.org.br/', array('attributes' => array('class' => 'rede-logo')));

  if (arg(0) == 'organizations' && arg(1) == 'search') {
    $vars['classes_array'][] = 'full-sized-map';
    $js = drupal_add_js(NULL, 'module', 'header');
    $views_path = drupal_get_path('module', 'views');
    unset($js['module'][$views_path . '/js/ajax_view.js']);
    $vars['scripts'] = drupal_get_js('header', $js);
  }

  if (isset($vars['node']) && ($vars['node']->type == 'nossasp_organization' || $vars['node']->type == 'nossasp_council')) { 
    foreach(taxonomy_node_get_terms_by_vocabulary($vars['node'], '2') as $orgtype) {
      $vars['classes_array'][] = 'org-type-' . $orgtype->tid;
      $vars['orgtype'] = $orgtype->name;
    }
    if (!empty($vars['node']->field_sigla[0]['value'])) {
      $vars['title'] .= ' — ' . $vars['node']->field_sigla[0]['value'];
    }
    $back_options = $_GET;
    unset($back_options['q']);
    $vars['back'] = l('Voltar', 'organizations/search', array('query' => $back_options));
  }
  elseif (arg(0) == 'node' && arg(1) == 'add') { 
    $vars['classes_array'][] = 'cadastro';
  }
  else { 
    $vars['title'] = FALSE;
  }

  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function nossasp_preprocess_node(&$vars, $hook) {
  $vars['terms'] = FALSE;
  // Optionally, run node-type-specific preprocess functions, like
  // nossasp_preprocess_node_page() or nossasp_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function nossasp_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function nossasp_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Theme callback for the export complete page.
 *
 * @param $file
 *  Link to output file
 */
function nossasp_views_data_export_complete_page($file, $errors = array(), $return_url = '') {
  drupal_set_title(t('Data export successful'));
  drupal_set_html_head('<meta http-equiv="refresh" content="3;url='. check_plain($file) . '" />');
  $output = '<h1 class="form-title">' . drupal_get_title() . '</h1>';
  $output .= '<p>';
  $output .= t('Your export has been created. View/download the file <a href="@link">here</a> (will automatically download in 3 seconds.)', array('@link' => $file));
  $output .= '</p>';

  if (!empty($return_url)) {
    $output .= '<p>';
    $output .= l(t('Return to previous page'), $return_url);
    $output .= '</p>';
  }
  return $output;
}

/**
 * Format a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results.
 * Format a list of nearby pages with additional query results.
 *
 * @param $tags
 *   An array of labels for the controls in the pager.
 * @param $limit
 *   The number of query results to display per page.
 * @param $element
 *   An optional integer to distinguish between multiple pagers on one page.
 * @param $parameters
 *   An associative array of query string parameters to append to the pager links.
 * @param $quantity
 *   The number of pages in the list.
 * @return
 *   An HTML string that generates the query pager.
 *
 * @ingroup themeable
 */
function nossasp_pager($tags = array(), $limit = 10, $element = 0, $parameters = array(), $quantity = 9) {
  global $pager_page_array, $pager_total;

  $quantity = 3;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', (isset($tags[0]) ? $tags[0] : t('« first')), $limit, $element, $parameters);
  $li_previous = theme('pager_previous', '<', $limit, $element, 1, $parameters);
  $li_next = theme('pager_next', '>', $limit, $element, 1, $parameters);
  $li_last = theme('pager_last', $pager_max, $limit, $element, $parameters);

  if ($pager_total[$element] > 1) {
    if ($li_previous) {
      $items[] = array(
        'class' => 'pager-previous',
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => 'pager-ellipsis',
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => 'pager-item',
            'data' => theme('pager_previous', $i, $limit, $element, ($pager_current - $i), $parameters),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => 'pager-current',
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => 'pager-item',
            'data' => theme('pager_next', $i, $limit, $element, ($i - $pager_current), $parameters),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => 'pager-ellipsis',
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_last) {
      $items[] = array(
        'class' => 'pager-last',
        'data' => $li_last,
      );
    }
    if ($li_next) {
      $items[] = array(
        'class' => 'pager-next',
        'data' => $li_next,
      );
    }
    return theme('item_list', $items, NULL, 'ul', array('class' => 'pager'));
  }
}



function nossasp_preprocess_node_form(&$vars) {
  global $user;

  if ($user->uid == 0) {
    $vars['form']['nodeformcols_region_main']['primaryterm'] = $vars['form']['nodeformcols_region_right']['primaryterm'];
    unset($vars['form']['nodeformcols_region_right']['primaryterm']);

    $vars['form']['nodeformcols_region_main']['field_atuacao'] = $vars['form']['nodeformcols_region_right']['group_atuacao']['field_atuacao'];
    unset($vars['form']['nodeformcols_region_right']['group_atuacao']);

    $vars['form']['nodeformcols_region_main']['buttons'] = $vars['form']['nodeformcols_region_right']['buttons'];
    unset($vars['form']['nodeformcols_region_right']['buttons']);

    $vars['form']['nodeformcols_region_main']['field_phone_text'] = $vars['form']['nodeformcols_region_right']['group_contact']['field_phone_text'];
    $vars['form']['nodeformcols_region_main']['field_email'] = $vars['form']['nodeformcols_region_right']['group_contact']['field_email'];
    $vars['form']['nodeformcols_region_main']['field_website'] = $vars['form']['nodeformcols_region_right']['group_contact']['field_website'];
    unset($vars['form']['nodeformcols_region_right']['group_contact']);

    $vars['form']['nodeformcols_region_main']['field_tipo'] = $vars['form']['nodeformcols_region_right']['group_tipo']['field_tipo'];
    unset($vars['form']['nodeformcols_region_right']['group_tipo']);

    $vars['form']['nodeformcols_region_main']['field_complemento'] = $vars['form']['nodeformcols_region_main']['group_address']['field_complemento'];
    $vars['form']['nodeformcols_region_main']['field_street'] = $vars['form']['nodeformcols_region_main']['group_address']['field_street'];
    unset($vars['form']['nodeformcols_region_main']['group_address']);
    
    $vars['form']['nodeformcols_region_main']['titlen']['#weight'] = -2;
    $vars['form']['nodeformcols_region_main']['titlen']['#value'] = '<h2>Sua organização</h2>';
    $vars['form']['nodeformcols_region_main']['briefn']['#weight'] = -1;
    $vars['form']['nodeformcols_region_main']['briefn']['#value'] = '<p>Os dados referentes à organização cadastrada serão de visualização pública e estarão publicados em regime de dados abertos para qualquer usuário do site.</p>';

    $vars['form']['nodeformcols_region_main']['field_sigla']['#weight'] = 1;
    $vars['form']['nodeformcols_region_main']['field_street']['#weight'] = 2;
    $vars['form']['nodeformcols_region_main']['field_complemento']['#weight'] = 3;
    $vars['form']['nodeformcols_region_main']['field_email']['#weight'] = 4;
    $vars['form']['nodeformcols_region_main']['field_phone_text']['#weight'] = 5;
    $vars['form']['nodeformcols_region_main']['field_phone_text'][0]['value']['#title'] = 'Telefone';
    $vars['form']['nodeformcols_region_main']['field_phone_text'][0]['value']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['field_website']['#weight'] = 6;
    $vars['form']['nodeformcols_region_main']['field_website'][0]['value']['#title'] = 'Site';
    $vars['form']['nodeformcols_region_main']['field_tipo']['#weight'] = 7;
    $vars['form']['nodeformcols_region_main']['field_tipo']['value']['#title'] = 'Tipo de Organização';
    $vars['form']['nodeformcols_region_main']['primaryterm']['#weight'] = 8;
    $vars['form']['nodeformcols_region_main']['primaryterm']['#title'] = 'Área de Atuação';
    $vars['form']['nodeformcols_region_main']['primaryterm']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['primaryterm']['#suffix'] = '<p><a href="#">Adicione outras áreas de atuação à sua organização</a><p>';
    $vars['form']['nodeformcols_region_main']['field_atuacao']['#weight'] = 8.5;
    $vars['form']['nodeformcols_region_main']['body_field']['#weight'] = 9;
    $vars['form']['nodeformcols_region_main']['buttons']['#weight'] = 10;
    $vars['form']['nodeformcols_region_main']['buttons']['submit']['#value'] = 'Criar Perfil';

    uasort($vars['form']['nodeformcols_region_main'], 'element_sort');

    $vars['form']['nodeformcols_region_main']['register']['#title'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['#title'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['name']['#title'] = 'Nome de Usuário';
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['name']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['mail']['#title'] = 'Email';
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['mail']['#description'] = FALSE;

    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_phone'] =     $vars['form']['nodeformcols_region_main']['register']['form']['info']['profile_phone'];
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_realname'] =     $vars['form']['nodeformcols_region_main']['register']['form']['info']['profile_realname'];
    unset($vars['form']['nodeformcols_region_main']['register']['form']['info']);

    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_phone']['#description'] = FALSE;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_realname']['#description'] = FALSE;
    
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['title']['#weight'] = -1;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['title']['#value'] = '<h2>Sua conta</h2>';
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['brief']['#weight'] = 0;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['brief']['#value'] = '<p>Ao criar uma conta no Mapa da Participação Cidadã você poderá cadastrar sua organização e editar as informações fornecidas sempre que necessário.</p>';
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_realname']['#weight'] = 1;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['name']['#weight'] = 2;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['mail']['#weight'] = 3;
    $vars['form']['nodeformcols_region_main']['register']['form']['account']['profile_phone']['#weight'] = 4;

    uasort($vars['form']['nodeformcols_region_main']['register']['form']['account'], 'element_sort');
  }
}

function nossasp_better_messages_content($display = NULL) {
	$output = '';
	$first = TRUE;
  $all = drupal_get_messages($display);
  if (arg(0) == 'obrigado' && $user->uid == 0) {
    foreach ($all['status'] as $key => $message) {
      if (substr($message, -7) == 'criado.' || substr($message, 0, 8)) { 
        unset($all['status'][$key]);
      }
    }
  }
	foreach ($all as $type => $messages) {
    if (!empty($messages)){
		$class = $first ? 'first' : '';
		$first = FALSE;
		$output .= "<h2 class=\"messages-label $type\">" . t(drupal_ucfirst($type)) . "</h2>\n";
		$output .= "<div class=\"messages $type\">\n";
		if (count($messages) > 1) {
			$output .= " <ul>\n";
			foreach ($messages as $k => $message) {
		        if ($k == 0) { $output .= "<li class='message-item first'>$message</li>"; }
		        else if ($k == count($messages) - 1) { $output .= "<li class='message-item last'>$message</li>"; }
		        else { $output .= "<li class='message-item'>$message</li>"; }
		    }
			$output .= " </ul>\n";
		}
		else { $output .= $messages[0];	}
		$output .= "</div>\n";
	} }
	return $output;
}
