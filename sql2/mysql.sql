CREATE TABLE `osa_scholarship` (
  `sn` int(11) unsigned NOT NULL auto_increment COMMENT '序號',
  `sch_name` varchar(255) NOT NULL COMMENT '獎學金名稱',
  `sch_link` varchar(255) NOT NULL COMMENT '辦法連結',
  `sch_depart` enum('undergraduate','graduate','both') NOT NULL COMMENT '獎助學門',
  `sch_require` text NOT NULL COMMENT '獎助對象與條件',
  `apply_date` date NOT NULL COMMENT '申請日期',
  `apply_form1` varchar(255) NOT NULL COMMENT '申請表1',
  `apply_link1` varchar(255) NOT NULL COMMENT '申請表1連結',
  `apply_form2` varchar(255) NOT NULL COMMENT '申請表2',
  `apply_link2` varchar(255) NOT NULL COMMENT '申請表2連結',
  `apply_form3` varchar(255) NOT NULL COMMENT '申請表3',
  `apply_link3` varchar(255) NOT NULL COMMENT '申請表3連結',
  `apply_way` enum('school','self') NOT NULL COMMENT '申請方式',
  `post_date` datetime NOT NULL COMMENT '登錄日期',
  `enable` enum('1','0') NOT NULL COMMENT '使否啟用',
PRIMARY KEY (`sn`)
) ENGINE=MyISAM;

