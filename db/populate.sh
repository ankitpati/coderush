#!/bin/bash

# populate.sh
# Date  : 13 November 2016
# Author: Ankit Pati

mysql -uroot -p < users.sql 2> /dev/null
mysql -ucoderush -pcoderush < schema.sql 2> /dev/null
mysql -ucoderush -pcoderush coderush < data.sql 2> /dev/null
mysql -ucoderush -pcoderush coderush

# end of populate.sh
