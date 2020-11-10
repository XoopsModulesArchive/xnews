<?php
// $Id: admin.php,v 1.18 2004/07/26 17:51:25 hthouzard Exp $
//%%%%%%	Admin Module Name  Articles 	%%%%%
define('_AM_NW_DBUPDATED', 'پایگاهداده با موفقیت بهروز شد!');
define('_AM_NW_CONFIG', 'تنظیمات اخبار');
define('_AM_NW_AUTOARTICLES', 'خبرهای خودکار');
define('_AM_NW_STORYID', 'شناسه خبر');
define('_AM_NW_TITLE', 'عنوان');
define('_AM_NW_TOPIC', 'سرفصل');
define('_AM_NW_POSTER', 'فرستنده');
define('_AM_NW_PROGRAMMED', 'زمان/تاریخ برنامهریزی شده');
define('_AM_NW_ACTION', 'عمل');
define('_AM_NW_EDIT', 'ویرایش');
define('_AM_NW_DELETE', 'حذف');
define('_AM_NW_LAST10ARTS', 'آخرین %d خبر قرارگرفته در سایت');
define('_AM_NW_PUBLISHED', 'تاریخ قرار گرفتن'); // Published Date
define('_AM_NW_GO', 'برو!');
define('_AM_NW_EDITARTICLE', 'ویرایش خبر');
define('_AM_NW_POSTNEWARTICLE', 'نوشتن خبر جدید');
define('_AM_NW_ARTPUBLISHED', 'خبر شما در سایت قرار گرفت!');
define('_AM_NW_HELLO', 'سلام %s');
define('_AM_NW_YOURARTPUB', 'خبری که برای سایت ارسال کردهبودید در سایت قرار گرفت');
define('_AM_NW_TITLEC', 'عنوان: ');
define('_AM_NW_URLC', 'آدرس: ');
define('_AM_NW_PUBLISHEDC', 'تاریخ قرارگرفتن: ');
define('_AM_NW_RUSUREDEL', 'آیا اطمینان دارید که میخواهید این خبر و تمام نظرهای آن را حذف کنید؟');
define('_AM_NW_YES', 'بله');
define('_AM_NW_NO', 'نه');
define('_AM_NW_INTROTEXT', 'متن وارد شده');
define('_AM_NW_EXTEXT', 'متن اضافی');
define('_AM_NW_ALLOWEDHTML', 'اجازه برای استفاده از کدهای HTML: ');
define('_AM_NW_DISAMILEY', 'غیرفعال کردن لبخندکها');
define('_AM_NW_DISHTML', 'غیر فعالکردن HTML');
define('_AM_NW_APPROVE', 'تایید');
define('_AM_NW_MOVETOTOP', 'این خبر را بالا ببر');
define('_AM_NW_CHANGEDATETIME', 'تغییر زمان/تاریخ قرار گرفتن خبر در سایت');
define('_AM_NW_NOWSETTIME', 'در حال حاضر در این تاریخ قرار دارد: %s'); // %s is datetime of publish
define('_AM_NW_CURRENTTIME', 'زمان در حال حاضر عبارت است از: %s');  // %s is the current datetime
define('_AM_NW_SETDATETIME', 'تعیین زمان/تاریخ قرار گرفتن خبر در سایت');
define('_AM_NW_MONTHC', 'ماه:');
define('_AM_NW_DAYC', 'روز:');
define('_AM_NW_YEARC', 'سال:');
define('_AM_NW_TIMEC', 'زمان:');
define('_AM_NW_PREVIEW', 'پیشنمایش');
define('_AM_NW_SAVE', 'ذخیره');
define('_AM_NW_PUBINHOME', 'قرار گرفتن خبر در صفحه اصلی؟');
define('_AM_NW_ADD', 'اضافه');

//%%%%%%	Admin Module Name  Topics 	%%%%%

define('_AM_NW_ADDMTOPIC', 'اضافهکردن یک سرفصل اصلی');
define('_AM_NW_TOPICNAME', 'عنوان سرفصل');
// Warning, changed from 40 to 255 characters.
define('_AM_NW_MAX40CHAR', '(حداکثر: 255 نویسه)');
define('_AM_NW_TOPICIMG', 'تصویر سرفصل');
define('_AM_NW_IMGNAEXLOC', 'نام تصویر + پیشوند در %s قرار دارد');
define('_AM_NW_FEXAMPLE', 'به عنوان مثال: games.gif');
define('_AM_NW_ADDSUBTOPIC', 'اضافهکردن یک زیر سرفصل');
define('_AM_NW_IN', 'در');
define('_AM_NW_MODIFYTOPIC', 'اصلاح سرفصل');
define('_AM_NW_MODIFY', 'اصلاح');
define('_AM_NW_PARENTTOPIC', 'سرفصل والد');
define('_AM_NW_SAVECHANGE', 'ذخیره تغییرات');
define('_AM_NW_DEL', 'حذف');
define('_AM_NW_CANCEL', 'انصراف');
define('_AM_NW_WAYSYWTDTTAL', 'هشدار: آیا مطمئن هستید که میخواهید این سر فصل را با تمام خبرها و نظرهای موجود در آن حذف کنید؟');

// Added in Beta6
define('_AM_NW_TOPICSMNGR', 'مدیریت سرفصلها');
define('_AM_NW_PEARTICLES', 'نوشتن/ویرایش خبرها');
define('_AM_NW_NEWSUB', 'ارسالهای جدید');
define('_AM_NW_POSTED', 'فرستاده شده در');
define('_AM_NW_GENERALCONF', 'تنظیمات اصلی');

// Added in RC2
define('_AM_NW_TOPICDISPLAY', 'تصویر سرفصل نشان دادهشود؟');
define('_AM_NW_TOPICALIGN', 'موقعیت');
define('_AM_NW_RIGHT', 'راست');
define('_AM_NW_LEFT', 'چپ');

define('_AM_NW_EXPARTS', 'خبرهای منقضی شده');
define('_AM_NW_EXPIRED', 'منقضی شده در');
define('_AM_NW_CHANGEEXPDATETIME', 'تغییر زمان/تاریخ منقضی شدن خبر در سایت');
define('_AM_NW_SETEXPDATETIME', 'تعیین زمان/تاریخ منقضی شدن خبر در سایت');
define('_AM_NW_NOWSETEXPTIME', 'در حال حاضر در این تاریخ قرار دارد: %s');

// Added in RC3
define('_AM_NW_ERRORTOPICNAME', 'شما باید یک نام برای سرفصل وارد کنید!');
define('_AM_NW_EMPTYNODELETE', 'چیزی برای حذف وجود ندارد!');

// Added 240304 (Mithrandir)
define('_AM_NW_GROUPPERM', 'دسترسی برای دیدن/ارسال/تایید اخبار');
define('_AM_NW_SELFILE', 'یک فایل را برای بارگذاری انتخاب کنید');

// Added by Hervé
define('_AM_NW_UPLOAD_DBERROR_SAVE', 'خطا در هنگام اتصال فایل به خبر');
define('_AM_NW_UPLOAD_ERROR', 'خطا در هنگام بارگذاری فایل');
define('_AM_NW_UPLOAD_ATTACHFILE', 'فایل(ها)ی متصل شده');
define('_AM_NW_APPROVEFORM', 'دسترسی برای تایید اخبار');
define('_AM_NW_SUBMITFORM', 'دسترسی برای ارسال اخبار');
define('_AM_NW_VIEWFORM', 'دسترسی برای دیدن اخبار');
define('_AM_NW_APPROVEFORM_DESC', 'انتخاب کنید چه گروههایی مجاز به تایید اخبار باشند');
define('_AM_NW_SUBMITFORM_DESC', 'انتخاب کنید چه گروههایی مجاز به ارسال اخبار باشند');
define('_AM_NW_VIEWFORM_DESC', 'انتخاب کنید چه گروههایی مجاز به دیدن اخبار باشند');
define('_AM_NW_DELETE_SELFILES', 'حذف فایلهای انتخاب شده');
define('_AM_NW_TOPIC_PICTURE', 'بارگذاری تصویر');
define('_AM_NW_UPLOAD_WARNING', '<B>هشدار، فراموش نکنید که برای شاخه مقابل دسترسی برای نوشتن بدهید : %s</B>');

define('_AM_NW_UPGRADECOMPLETE', 'ارتقا کامل شد');
define('_AM_NW_UPDATEMODULE', 'تمپلیتهای ماژول و بلاک را به روز کنید');
define('_AM_NW_UPGRADEFAILED', 'ارتقا با مشکل روبرو شد');
define('_AM_NW_UPGRADE', 'ارتقا');
define('_AM_NW_ADD_TOPIC', 'اضافهکردن سر فصل');
define('_AM_NW_ADD_TOPIC_ERROR', 'خطا: سرفصل در حال حاضر وجود دارد!');
define('_AM_NW_ADD_TOPIC_ERROR1', 'خطا: امکان اینکه این سرفصل را به عنوان سرفصل والد قرار داد وجود ندارد');
define('_AM_NW_SUB_MENU', 'قرار دادن این سرفصل به عنوان یک زیر منو در منوی اصلی');
define('_AM_NW_SUB_MENU_YESNO', 'زیرمنو؟');
define('_AM_NW_HITS', 'بازدید');
define('_AM_NW_CREATED', 'ساختهشده در');

define('_AM_NW_TOPIC_DESCR', 'شرح سرفصل');
define('_AM_NW_USERS_LIST', 'فهرست کاربران');
define('_AM_NW_PUBLISH_FRONTPAGE', 'در صفحه اصلی قرار گیرد؟');
define('_AM_NW_UPGRADEFAILED1', 'امکان ایجاد جدول stories_files وجود ندارد');
define('_AM_NW_UPGRADEFAILED2', 'امکان تغییر طول عنوان سرفصل وجود ندارد');
define('_AM_NW_UPGRADEFAILED21', 'امکان اضافهکردن فیلدهای جدید به جدول سرفصلها وجود ندارد');
define('_AM_NW_UPGRADEFAILED3', 'امکان ایجاد جدول stories_votedata وجود ندارد');
define('_AM_NW_UPGRADEFAILED4', "امکان ایجاد دو فیلد 'rating' و 'votes' برای جدول 'story' وجود ندارد");
define('_AM_NW_UPGRADEFAILED0', 'لطفا به پیغامها توجه کنید و سعی کنید ایرادات را با رفتن به phpMyadmin و sql بر طرف کنید');
define('_AM_NW_UPGR_ACCESS_ERROR', 'خطا در اجرای فایل بهروز رسانی! شما باید مدیر ماژول باشید تا ارتقا انجام شود');
define('_AM_NW_PRUNE_BEFORE', 'هرس کردن خبرهایی که قبل از این تاریخ در سایت قرار گرفتهاند');
define('_AM_NW_PRUNE_EXPIREDONLY', 'فقط خبرهایی را حذف کن که منقضی شدهاند');
define('_AM_NW_PRUNE_CONFIRM', 'هشدار، شما میخواهید اخباری را که قبل از %s منتشر شدهاند پاک کنید (البته این کار غیر ممکن نیست). این عمل اخبار %s را نمایان می کند.<br>آیا اطمینان دارید؟');
define('_AM_NW_PRUNE_TOPICS', 'محدود به سرفصلهای زیر');
define('_AM_NW_PRUNENEWS', 'هرس کردن خبرها');
define('_AM_NW_EXPORT_NEWS', 'خروجی اخبار با فرمت xml');
define('_AM_NW_EXPORT_NOTHING', 'متاسفانه چیزی برای خارج کردن وجود ندارد درخواست خود را بررسی کنید');
define('_AM_NW_PRUNE_DELETED', '%d خبر حذف شد');
define('_AM_NW_PERM_WARNING', '<h2>هشدار، شما سه فرم در پیش رو دارید در نتیجه سه دکمه برای ارسال دارید</h2>');
define('_AM_NW_EXPORT_BETWEEN', 'خروجی گرفتن از خبرهای قرار گرفته در سایت بین تاریخ');
define('_AM_NW_EXPORT_AND', ' و ');
define('_AM_NW_EXPORT_PRUNE_DSC', 'اگر هیچکدام را انتخاب نکنید همه سرفصلها در نظر گرفته میشوند<br> وگرنه فقط سرفصلهای انتخاب شده در نظر گرفته میشوند');
define('_AM_NW_EXPORT_INCTOPICS', 'تعریفهای سرفصلها را هم شامل شود؟');
define('_AM_NW_EXPORT_ERROR', 'خطا در هنگام ایجاد فایل %s. عمل متوقف شد.');
define('_AM_NW_EXPORT_READY', "فایل خروجی به صورت xml برای دانلود آماده است <br><a href='%s'>بر روی این لینک کلید کنید تا دانلود آغاز شود</a>.<br>فراموش نکنید که بعد از اتمام دانلود <a href='%s'>با کلیک بر روی این لینک آن را حذف کنید</a>");
define('_AM_NW_RSS_URL', 'آدرس برای RSS feed');
define('_AM_NW_NEWSLETTER', 'خبرنامه');
define('_AM_NW_NEWSLETTER_BETWEEN', 'انتخاب خبرهای قرار گرفته در سایت بین تاریخ');
define('_AM_NW_NEWSLETTER_READY', "فایل خبرنامه برای دانلود آماده است <br><a href='%s'>بر روی این لینک کلید کنید تا دانلود آغاز شود</a>.<br>فراموش نکنید که بعد از اتمام دانلود <a href='%s'>با کلیک بر روی این لینک آن را حذف کنید</a>");
define('_AM_NW_DELETED_OK', 'فایل با موفقیت حذف شد');
define('_AM_NW_DELETED_PB', 'مشکلی در هنگام حذف فایل رخ داد');
define('_AM_NW_STATS0', 'آمار سرفصلها');
define('_AM_NW_STATS', 'آمار');
define('_AM_NW_STATS1', 'نویسنده تک خبر');
define('_AM_NW_STATS2', 'همه');
define('_AM_NW_STATS3', 'آمار خبرها');
define('_AM_NW_STATS4', 'خبرهای بیشتر خوانده شده');
define('_AM_NW_STATS5', 'خبرهای کمتر خوانده شده');
define('_AM_NW_STATS6', 'خبرهای با ارزش بیشتر');
define('_AM_NW_STATS7', 'نویسندههایی که خبرهایشان بیشتر از همه خوانده شده است');
define('_AM_NW_STATS8', 'نویسندههایی که خبرهایشان بیشترین ارزش را کسب کرده است');
define('_AM_NW_STATS9', 'اعضایی که بالاترین همکاری را در ارسال خبر دارند');
define('_AM_NW_STATS10', 'آمار نویسندهها');
define('_AM_NW_STATS11', 'تعداد خبر فرستاده شده');
define('_AM_NW_HELP', 'کمک');
define('_AM_NW_MODULEADMIN', 'مدیریت ماژول');
define('_AM_NW_GENERALSET', 'تنظیمات ماژول');
define('_AM_NW_GOTOMOD', 'برو به ماژول');
define('_AM_NW_NOTHING', 'متاسفانه چزی برای دانلود وجود ندارد مسیر خود را بررسی کنید');
define('_AM_NW_NOTHING_PRUNE', 'متاسفانه خبری برای هرسشدن وجود ندارد درخواست خود را بررسی کنید');
define('_AM_NW_TOPIC_COLOR', 'رنگ سرفصل');
define('_AM_NW_COLOR', 'رنگ');
define('_AM_NW_REMOVE_BR', 'تبدیل کدهای &lt;br&gt; به خط جدید؟');
// Added in 1.3 RC2
define('_AM_NW_PLEASE_UPGRADE', "<a href='upgrade.php'><font color='#FF0000'>لطفا در صورتی که ورژن ماژول اخبار شما 1.1 یا 1.2.1 است با کلیک بر روی این لینک ماژول را ارتقا دهید !</font></a>");

// Added in verisn 1.50
define('_AM_NW_NEWSLETTER_HEADER', 'سر صفحه');
define('_AM_NW_NEWSLETTER_FOOTER', 'پا صفحه');
define('_AM_NW_NEWSLETTER_HTML_TAGS', 'کدهای html  حذف شوند؟');
define('_AM_NW_VERIFY_TABLES', 'تعمیر جدولها');
define('_AM_NW_METAGEN', 'موتور متا');
define('_AM_NW_METAGEN_DESC', 'موتورمتا Metagen  سیستمی است که باعث بهتر ایندکس شدن لینکهای خبری شما در موتورهای جستجو میشود<br>اگر کلمات کلیدی و شرح مطلب را خودتان ننویسید ماژول به طور اتوماتیک آنها را مینویسد.');
define('_AM_NW_BLACKLIST', 'لیست سیاه');
define('_AM_NW_BLACKLIST_DESC', 'کلمات نوشته شده در این لیست در ساختن کلمات موتور متا استفاده نمیشوند');
define('_AM_NW_BLACKLIST_ADD', 'اضافهکردن');
define('_AM_NW_BLACKLIST_ADD_DSC', 'کلمات را برای اضافه شدن وارد کنید<br>(هر خط یک کلمه)');
define('_AM_NW_META_KEYWORDS_CNT', 'حداکثر تعداد کلماتکلیدی برای ساختهشدن توسط موتور متا به صورت اتوماتیک');
define('_AM_NW_META_KEYWORDS_ORDER', 'چینش کلماتکلیدی');
define('_AM_NW_META_KEYWORDS_INTEXT', 'ساخته شدن با ترتیبی که در متن ظاهر شدهاند');
define('_AM_NW_META_KEYWORDS_FREQ1', 'به ترتیبی که بیشتر استفاده شدهاند');
define('_AM_NW_META_KEYWORDS_FREQ2', 'به ترتیبی که کمتر استفاده شدهاند');

// Added in version 1.67 Beta
define('_AM_NW_SUBPREFIX', 'زیر-پیشوند');

define('_AM_NW_CLONER', 'تکثیر');
define('_AM_NW_CLONER_CLONES', 'کپی ها');
define('_AM_NW_CLONER_ADD', 'اضافه کردن کپی');
define('_AM_NW_CLONER_ID', 'ID');
define('_AM_NW_CLONER_NAME', 'اخبار');
define('_AM_NW_CLONER_DIRFOL', 'مسیر/پوشه');
define('_AM_NW_CLONER_VERSION', 'نسخه');

define('_AM_NW_CLONER_NEWNAME', 'نام ماژول جدید');
define(
    '_AM_NW_CLONER_NEWNAMEDESC',
    "این قسمت یک پوشه جدید برای ماژول ایجاد میکند. <br> حساسیت ها و نام های نا صحیح به طور خودکار اصلاح میشود. <br> به طور مثال. نام جدید = <b>Library</b> شاخه جدید  = <b>library</b>, <br> نام جدید <b>My Library</b> شاخه جدید = <b>mylibrary</b>. <br><br> نام ماژول فعلی: <font color='#008400'><b> %s </b></font><br>"
);
define('_AM_NW_CLONER_NEWNAMELABEL', 'ماژول جدید:');

define('_AM_NW_CLONER_DIREXISTS', "مسیر/شاخه '%s' هم اکنون موجود است !!");
define('_AM_NW_CLONER_CREATED', "ماژول '%s' هم اکنون تکثیر شد !!");
define('_AM_NW_CLONER_UPRADED', "ماژول '%s' هم اکنون به روز شد!!");
define('_AM_NW_CLONER_NOMODULEID', 'شماره ماژول تنظیم نشده است');

define('_AM_NW_CLONER_UPDATE', 'به روز کردن');
define('_AM_NW_CLONER_INSTALL', 'نصب');
define('_AM_NW_CLONER_UNINSTALL', 'حذف');
define('_AM_NW_CLONER_ACTION_INSTALL', 'نصب/حذف');

define('_AM_NW_CLONER_IMPORTNEWS', 'وارد کردن اطلاعات ماژول اخبار');
define('_AM_NW_CLONER_IMPORTNEWSDESC1', 'ماژول اخبار در دسترس است ! اطلاعات آن منتقل شود؟');
define(
    '_AM_NW_CLONER_IMPORTNEWSDESC2',
    'این گزینه زمانی فعال است که جدول stories این ماژول خالی باشد. <br>
                                         اگر شما قبل از وارد کردن اطلاعات خبری در این ماژول ارسال کرده باشید<br>
                                          باید ابتدا این ماژول رو از نصب خارج کرده و مجدد نصب کنید. <br>
                                         اگر شما هم اکنون اطلاعات را از ماژول اخبار منتقل کرده اید از این بخش خارج شود.'
);
define('_AM_NW_CLONER_IMPORTNEWSSUB', 'وارد کردن');
define('_AM_NW_CLONER_NEWSIMPORTED', 'اطلاعات ماژول اصلی اخبار هم اکنون منتقل شذ');

// Added in version 1.68 Beta
define(
    '_AM_NW_DESCRIPTION',
    '<H3>ماژول xNews نسخه تکثیر شونده ماژول News</H3> 
							  کاربران میتوانند خبر یا نظر ارسال کنند . این ماژول میتواند تکثیر شود و با یک روش امکان استفاده های متفاوت را فراهم کند . همچنین علاوه بر اخبار برای استفاده های دیگر هم مناسب است . و میتوانید آن را با استفاده از عنوان ها و بلاک ها و تنظیمات  شخصی سازی کنید. '
);

// Added in version 1.68 RC1
define('_AM_NW_CLONER_CLONEDELETED', "کلون '%s' با موفقیت حذف شد .");
define('_AM_NW_CLONER_CLONEDELETEDERR', "کلون '%s' حذف نشد . لطفا دسترسی ها را برسی کنید");
define('_AM_NW_CLONER_CLONEUPGRADED', 'به روز شده');
define('_AM_NW_CLONER_UPGRADEFORCE', 'آپگرید اجباری');
define('_AM_NW_CLONER_CLONEDELETION', 'حذف کلون');
define('_AM_NW_CLONER_SUREDELETE', "آیا اطمینان دارید که میخواهید کلون <font color='#000000'>'%s'</font> را حذف کنید؟<br>");
define('_AM_NW_CLONER_CLONEID', 'ID کلون تنظیم نشده است !');

// Added in version 1.68 RC2
define('_AM_NW_INDEX', 'صفحه اصلی مدیریت');

// Added in version 1.68 RC3
define('_AM_NW_DOLINEBREAK', 'فعال کردن خط شکسته');

define('_AM_NW_TOPICS', 'سرفصل ها');
