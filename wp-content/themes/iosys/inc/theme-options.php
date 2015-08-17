<?php
/**
 * テーマオプション
 *
 * @access public
 * @package Wordpress themeOptions
 * @version 1.0.1
 * @since iosys.
 * @author Y.S
 */

class themeOptions extends setOption {

    /**
     * オプション設定情報
     */
    private $themeOptions;

    /**
     * カスタマイズリンク
     */
    private $customizer_link;

    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() {
        $this->themeOptions = parent::get_options();

        add_action( 'admin_menu', array(&$this, 'iosys_theme_options_add_page'));
        add_action( 'admin_init', array(&$this, 'iosys_theme_options_init'));
        add_action( 'admin_head', array(&$this, 'iosys_admin_css'), 11);
        $this->customizer_link = '<a href="'.get_admin_url().'customize.php">テーマカスタマイズ</a>';
    }

    /**
     * 管理画面にテーマページ追加
     */
    public function iosys_theme_options_add_page() {
        $theme_page = add_theme_page(
          'テーマ設定',
          'テーマ設定',
          'edit_theme_options',
          'theme_options',
          array( &$this, 'iosys_theme_options_render_page')
        );

        if ( ! $theme_page ) return;
    }

    /**
     * テーマオプションの設定
     */
    public function iosys_theme_options_init() {

        register_setting(
          'iosys_options',
          'iosys_theme_options',
          array( &$this, 'iosys_theme_options_validate')
        );
    }

    /**
     * テーマオプション用css
     */
    public function iosys_admin_css(){
        $adminCssPath = '/css/iosys_admin.css';
        wp_enqueue_style( 'themeOptions', $adminCssPath , false);
    }

    /**
     * テーマオプション画面
     */
    public function iosys_theme_options_render_page() { ?>
    <div class="wrap" id="iosys_options">
        <h2><?php printf( __( '%s テーマ設定', '' ), wp_get_theme() ); ?></h2>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
        <?php
            settings_fields( 'iosys_options' );
            $options = $this->themeOptions;
        ?>

    <div id="logo" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>ロゴの設定 <span>-画像がない場合はサイト名が表示されます-</span></h3>
      <table>
        <tr>
          <th><?php if (!empty($options['logo']) ) : ?><p><img src="<?php echo esc_attr($options['logo']); ?>"></p><?php else: ?>ロゴが登録されていません<br /><br /><?php endif; ?>
        ヘッダーロゴ画像 URL <br />[ <a href="<?php echo site_url(); ?>/wp-admin/media-new.php" target="_blank">画像のアップロード</a> ] </th>
          <td><input type="text" name="iosys_theme_options[logo]" id="logo" value="<?php echo esc_attr($options['logo']); ?>" style="width:100%;" /><br /><span>例) /img/2015/08/sain.jpg</span>
        </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </div>

    <div id="about" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>ご挨拶 <span>- 文章と画像を設定することができます -</span></h3>
      <table>
        <tr>
          <th>ご挨拶文章</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[aboutBody]" id="aboutBody" value="" /><?php if(isset($options['aboutBody'])):?><?php echo esc_attr($options['aboutBody']); ?><?php endif;?></textarea><br />
          <span>※改行した箇所はそのままweb側に表示されます</span>
          </td>
        </tr>
        <tr>
            <th><?php if (!empty($options['aboutLogo'])) : ?><p><img src="<?php echo esc_attr($options['aboutLogo']); ?>" width="200"></p><?php else: ?>画像が登録されていません<br /><br /><?php endif; ?>
          画像 URL <br />[ <a href="<?php echo site_url(); ?>/wp-admin/media-new.php" target="_blank">画像のアップロード</a> ] </th>
          <td><input type="text" name="iosys_theme_options[aboutLogo]" id="aboutLogo" value="<?php echo esc_attr($options['aboutLogo']); ?>" style="width:100%;" /><br /><span>例) /img/2015/08/sain.jpg</span>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </div>
            
    <div id="service" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>イオシスでやっていること（業務内容）の設定</h3>
      <table style="margin-bottom:20px">
        <tr>
          <th>紹介文章</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[serviceBody]" id="serviceBody" value="" /><?php if(isset($options['serviceBody'])):?><?php echo esc_attr($options['serviceBody']); ?><?php endif;?></textarea><br />
          <span>※改行した箇所はそのままweb側に表示されます</span>
          </td>
        </tr>
        <tr>
          <th>表示数(左側)</th>
          <td>
            <input type="text" name="iosys_theme_options[serviceNumLeft]" id="serviceNumLeft" value="<?php if(isset($options['serviceNumLeft'])):?><?php echo esc_attr( $options['serviceNumLeft'] ); ?><?php else:?>1<?php endif;?>" /><br />
            <span>表示させる業務内容数を設定し「変更を保存」すると登録フォームが表示されます</span>
          </td>
        </tr>
        <tr>
          <th>表示数(右側)</th>
          <td>
            <input type="text" name="iosys_theme_options[serviceNumRight]" id="serviceNumRight" value="<?php if(isset($options['serviceNumRight'])):?><?php echo esc_attr( $options['serviceNumRight'] ); ?><?php else:?>1<?php endif;?>" /><br />
            <span>表示させる業務内容数を設定し「変更を保存」すると登録フォームが表示されます</span>
          </td>
        </tr>
      </table>
      <p>左側</p>
      <table class="form-table">
      <?php
          for ( $s = 1; $s <= $options['serviceNumLeft']; $s++ ) :
              $serviceLinkLeft = 'serveceLinkLeft'.$s;
              $serviceTitleLeft = 'serviceTitleLeft'.$s;
              $serviceCommentLeft = 'serviceCommentLeft'.$s;
              $serviceIconLeft = 'serviceIconLeft'.$s;
      ?>
        <tr>
          <td>リンクURL [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceLinkLeft; ?>]" id="<?php echo $serviceLinkLeft; ?>" value="<?php echo esc_attr($options[$serviceLinkLeft]) ?>" /></td>
          <td>業務タイトル [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceTitleLeft ?>]" id="<?php echo $serviceTitleLeft ?>" value="<?php echo esc_attr( $options[$serviceTitleLeft] ) ?>" /></td>
          <td>業務内容 [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceCommentLeft ?>]" id="<?php echo $serviceCommentLeft ?>" value="<?php echo esc_attr( $options[$serviceCommentLeft] ) ?>" /></td>
          <td>アイコン [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceIconLeft ?>]" id="<?php echo $serviceIconLeft ?>" value="<?php echo esc_attr( $options[$serviceIconLeft] ) ?>" /></td>
        </tr>
      <?php endfor; ?>
      </table>
      
      <p>右側</p>
      <table class="form-table">
      <?php
          for ( $s = 1; $s <= $options['serviceNumRight']; $s++ ) :
              $serviceLinkRight = 'serveceLinkRight'.$s;
              $serviceTitleRight = 'serviceTitleRight'.$s;
              $serviceCommentRight = 'serviceCommentRight'.$s;
              $serviceIconRight = 'serviceIconRight'.$s;
      ?>
        <tr>
          <td>リンクURL [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceLinkRight; ?>]" id="<?php echo $serviceLinkRight; ?>" value="<?php echo esc_attr($options[$serviceLinkRight]) ?>" /></td>
          <td>業務タイトル [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceTitleRight ?>]" id="<?php echo $serviceTitleRight ?>" value="<?php echo esc_attr( $options[$serviceTitleRight] ) ?>" /></td>
          <td>業務内容 [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceCommentRight ?>]" id="<?php echo $serviceCommentRight ?>" value="<?php echo esc_attr( $options[$serviceCommentRight] ) ?>" /></td>
          <td>アイコン [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $serviceIconRight ?>]" id="<?php echo $serviceIconRight ?>" value="<?php echo esc_attr( $options[$serviceIconRight] ) ?>" /></td>
        </tr>
      <?php endfor; ?>
      </table>
      <?php submit_button(); ?>
    </div>
    
    <div id="recruit" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>一緒に働きませんか（採用情報）の設定</h3>
      <table>
        <tr>
          <th>採用情報コメント</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitBody]" id="recruitBody" value="" /><?php if(isset($options['recruitBody'])):?><?php echo esc_attr($options['recruitBody']); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>給与</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitSalary]" id="recruitSalary" value="" /><?php if(isset($options['recruitSalary'])):?><?php echo esc_attr($options['recruitSalary']); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>賞与</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitBonus]" id="recruitBonus" value="" /><?php if(isset($options['recruitBonus'])):?><?php echo esc_attr( $options['recruitBonus'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>手当</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitAllowance]" id="recruitAllowance" value="" /><?php if(isset($options['recruitAllowance'])):?><?php echo esc_attr( $options['recruitAllowance'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>勤務時間</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitWorkingHours]" id="recruitWorkingHours" value="" /><?php if(isset($options['recruitWorkingHours'])):?><?php echo esc_attr( $options['recruitWorkingHours'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>休日・休暇</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitVacation]" id="recruitVacation" value="" /><?php if(isset($options['recruitVacation'])):?><?php echo esc_attr( $options['recruitVacation'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>福利厚生</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[recruitWelfare]" id="recruitWelfare" value="" /><?php if(isset($options['recruitWelfare'])):?><?php echo esc_attr( $options['recruitWelfare'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </div>

    <div id="company" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>会社概要の設定</h3>
      <table>
        <tr>
          <th>本社</th>
          <td>
          <input type="text" name="iosys_theme_options[companyInfo]" id="companyInfo" value="<?php if(isset($options['companyInfo'])):?><?php echo esc_attr($options['companyInfo']); ?><?php endif;?>" />
          </td>
        </tr>
        <tr>
          <th>設立</th>
          <td>
          <input type="text" name="iosys_theme_options[companyEstablish]" id="companyEstablish" value="<?php if(isset($options['companyEstablish'])):?><?php echo esc_attr($options['companyEstablish']); ?><?php endif;?>" />
          </td>
        </tr>
        <tr>
          <th>資本金</th>
          <td>
          <input type="text" name="iosys_theme_options[companyCapital]" id="companyCapital" value="<?php if(isset($options['companyCapital'])):?><?php echo esc_attr($options['companyCapital']); ?><?php endif;?>" />
          </td>
        </tr>
        <tr>
          <th>従業員数</th>
          <td>
          <input type="text" name="iosys_theme_options[companyStaff]" id="companyStaff" value="<?php if(isset($options['companyStaff'])):?><?php echo esc_attr($options['companyStaff']); ?><?php endif;?>" />
          </td>
        </tr>
        <tr>
          <th>事業内容</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[companyBusiness]" id="companyBusiness" value="" /><?php if(isset($options['companyBusiness'])):?><?php echo esc_attr( $options['companyBusiness'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>主要取引先</th>
          <td>
          <textarea style="width:50%" rows="10" name="iosys_theme_options[companyClient]" id="companyClient" value="" /><?php if(isset($options['companyClient'])):?><?php echo esc_attr( $options['companyClient'] ); ?><?php endif;?></textarea><br />
          <span>複数行可能</span>
          </td>
        </tr>
        <tr>
          <th>認可</th>
          <td>
          <input type="text" name="iosys_theme_options[companyApproval]" id="companyApproval" value="<?php if(isset($options['companyApproval'])):?><?php echo esc_attr($options['companyApproval']); ?><?php endif;?>" />
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </div>
    
    <div id="slideSetting" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>スライドショーの設定</h3>
      <table style="margin-bottom:20px">
        <tr>
          <th>スライド画像数</th>
          <td>
            <input type="text" name="iosys_theme_options[slideNum]" id="slideNum" value="<?php if(isset($options['slideNum'])):?><?php echo esc_attr( $options['slideNum'] ); ?><?php else:?>1<?php endif;?>" /><br />
            <span>表示させる画像数を設定し「変更を保存」すると画像登録フォームが表示されます</span>
          </td>
        </tr>
      </table>
      <table class="form-table">
      <?php
          for ( $s = 1; $s <= $options['slideNum']; $s++ ) :
              $slideLink = 'slideLink'.$s;
              $slideImage = 'slideImage'.$s;
              $slideAlt = 'slideAlt'.$s;
              $slideDisplay = 'slideDisplay'.$s;
              $slideBlank = 'slideBlank'.$s
      ?>
        <tr>
          <td>リンクURL [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $slideLink; ?>]" id="<?php echo $slideLink; ?>" value="<?php echo esc_attr( $options[$slideLink] ) ?>" /></td>
          <td>画像URL [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $slideImage ?>]" id="<?php echo $slideImage ?>" value="<?php echo esc_attr( $options[$slideImage] ) ?>" /> [ <a href="<?php echo site_url(); ?>/wp-admin/media-new.php" target="_blank">画像のアップロード</a> ]</td>
          <td>代替テキスト (alt) [<?php echo $s; ?>]<br /><input type="text" name="iosys_theme_options[<?php echo $slideAlt ?>]" id="<?php echo $slideAlt ?>" value="<?php echo esc_attr( $options[$slideAlt] ) ?>" /></td>
          <td>
            <label><input type="checkbox" name="iosys_theme_options[<?php echo $slideDisplay ?>]" id="<?php echo $slideDisplay ?>" value="true" <?php if ($options[$slideDisplay]) :echo ' checked';endif; ?>> 非表示にする</label><br />
            <label><input type="checkbox" name="iosys_theme_options[<?php echo $slideBlank ?>]" id="<?php echo $slideBlank ?>" value="true" <?php if ($options[$slideBlank]) :echo ' checked';endif; ?>> 別ウィンドウで開く</label>
          </td>
        </tr>
      <?php endfor; ?>
      </table>
      <?php submit_button(); ?>
    </div>


    <div id="seoSetting" class="sectionBox">
    <?php get_template_part('inc/theme-options-nav'); ?>
      <h3>SEO と Google Analytics の設定</h3>
      <table>
        <tr>
          <th>TOPページdescription</th>
          <td>TOPページ用のdescriptionです。その他ページは本文文頭より240文字がdescriptionとして適用される仕様となっています。
            <textarea rows="5" name="iosys_theme_options[metaDes]" id="metaDes" value="" style="width:90%;" /><?php echo esc_attr( $options['metaDes'] ); ?></textarea><br />
          </td>
        </tr>
        <tr>
          <th>基本keywords</th>
          <td>metaタグのキーワードで、サイト全体で共通して入れるキーワードを , 区切りで入力して下さい。
            <input type="text" class="default" name="iosys_theme_options[metaKeyWord]" id="metaKeyWord" value="<?php echo esc_attr( $options['metaKeyWord'] ); ?>"  style="width:90%;" /><br />
            * 各ページ個別のキーワードについては、それぞれの記事の編集画面より入力して下さい。共通キーワードと合わせて最大10個程度が望ましいです。<br />
            * 最後のキーワード欄の末尾には , は必要ありません。<br />
            【記入例】 WordPress,Template,Theme,Free,GPL
          </td>
        </tr>
        <tr>
          <th>Google Analytics設定</th>
          <td>GoogleAnalyticsのタグを埋め込む場合はAnalyticsのIDを記入して下さい。<br />
          <p>UA-<input type="text" name="iosys_theme_options[gaID]" id="gaID" value="<?php echo esc_attr( $options['gaID'] ); ?>" style="width:90%;" /><br />
          【記入例】XXXXXXXX-X</p>
          <dl>
            <dt>出力する解析タグの種類を選択して下さい。（よくわからない場合は飛ばしてかまいません。）</dt>
            <dd>
            <?php
                $iosys_gaTypes = array(
                    'gaType_normal' => '通常の解析タグのみ出力する（デフォルト）',
                    'gaType_universal' => 'Universal Analyticsの解析タグのみ出力する',
                    'gaType_both' => '両方の解析タグを出力する'
                    );
                foreach( $iosys_gaTypes as $iosys_gaTypeValue => $iosys_gaTypeLavel) {
                    if ( $iosys_gaTypeValue == $options['gaType'] ) { ?>
                    <label><input type="radio" name="iosys_theme_options[gaType]" value="<?php echo $iosys_gaTypeValue ?>" checked> <?php echo $iosys_gaTypeLavel ?></label><br />
                    <?php } else { ?>
                    <label><input type="radio" name="iosys_theme_options[gaType]" value="<?php echo $iosys_gaTypeValue ?>"> <?php echo $iosys_gaTypeLavel ?></label><br />
                <?php }
            }?>
            </dd>
            </dl>
          </td>
        </tr>
      </table>
    <?php submit_button(); ?>
    </div>


    <?php
    }

    public function iosys_theme_options_validate($input) {
      //$output = $defaults = $this->themeOptions->iosys_get_default_theme_options();
      
      // ロゴ
      $output['logo'] = $input['logo'];
        
      // ご挨拶
      $output['aboutBody'] = $input['aboutBody'];
      $output['aboutLogo'] = $input['aboutLogo'];
      
      // イオシスでやっていること
      $output['serviceBody'] = $input['serviceBody'];
      $output['serviceNumLeft'] = $input['serviceNumLeft'];
      for ( $s = 1; $s <= $output['serviceNumLeft']; $s++ ) {
        $output['slideLinkLeft'.$s] = $input['slideLinkLeft'.$s];
        $output['serviceTitleLeft'.$s] = $input['serviceTitleLeft'.$s];
        $output['serviceCommentLeft'.$s] = $input['serviceCommentLeft'.$s];
        $output['serviceIconLeft'.$s] = $input['serviceIconLeft'.$s];
      }

      $output['serviceNumRight'] = $input['serviceNumRight'];
      for ( $s = 1; $s <= $output['serviceNumRight']; $s++ ) {
        $output['slideLinkRight'.$s] = $input['slideLinkRight'.$s];
        $output['serviceTitleRight'.$s] = $input['serviceTitleRight'.$s];
        $output['serviceCommentRight'.$s] = $input['serviceCommentRight'.$s];
        $output['serviceIconRight'.$s] = $input['serviceIconRight'.$s];
      }
      
      // 一緒に働きませんか
      $output['recruitBody'] = $input['recruitBody'];
      $output['recruitSalary'] = $input['recruitSalary'];
      $output['recruitBonus'] = $input['recruitBonus'];
      $output['recruitAllowance'] = $input['recruitAllowance'];
      $output['recruitWorkingHours'] = $input['recruitWorkingHours'];
      $output['recruitVacation'] = $input['recruitVacation'];
      $output['recruitWelfare'] = $input['recruitWelfare'];
      
      // 会社概要
      $output['companyInfo'] = $input['companyInfo'];
      $output['companyEstablish'] = $input['companyEstablish'];
      $output['companyCapital'] = $input['companyCapital'];
      $output['companyStaff'] = $input['companyStaff'];
      $output['companyBusiness'] = $input['companyBusiness'];
      $output['companyClient'] = $input['companyClient'];
      $output['companyApproval'] = $input['companyApproval'];

      // TDK
      $output['metaDes'] = $input['metaDes'];
      $output['metaKeyWord'] = $input['metaKeyWord'];
      $output['gaID'] = $input['gaID'];
      $output['gaType'] = $input['gaType'];

      // スライド
      $output['slideNum'] = $input['slideNum'];
      for ( $s = 1; $s <= $output['slideNum']; $s++ ) {
          $output['slideLink'.$s] = $input['slideLink'.$s];
          $output['slideImage'.$s] = $input['slideImage'.$s];
          $output['slideAlt'.$s] = $input['slideAlt'.$s];
          $output['slideDisplay'.$s] = $input['slideDisplay'.$s];
          $output['slideBlank'.$s] = $input['slideBlank'.$s];
      }

      return apply_filters('iosys_theme_options_validate', $output, $input);
    }
}
?>