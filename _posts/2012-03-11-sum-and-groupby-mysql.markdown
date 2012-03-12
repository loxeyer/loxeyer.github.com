---
layout: post
title:mysql的分组求和
tags: [tech]
---

{%highlight console%}
		$sql = "set @line=0;
			select imei_total,imei_count,dateTime from (
			select @line := @line + imei_count imei_total ,imei_count,dateTime  from(
			select count(DISTINCT(imei)) imei_count,from_unixtime(record_datetime,'%Y-%m-%d') dateTime from detail_user_data_agent_install_info where channel_id=2 and record_datetime < $strtime[1] group by dateTime limit 0,30
			 ) x  group by dateTime order by dateTime desc) x ;

			";

{%endhighlight%}
