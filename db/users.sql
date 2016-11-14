/* users.sql */
/* Date  : 13 November 2016
 * Author: Ankit Pati
 */

drop user if exists coderush@localhost;
create user coderush@localhost identified by "coderush";
grant all privileges on coderush.* to coderush@localhost;
/* end of users.sql */
