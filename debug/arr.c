/* arr.c */
/* CodeRush
 * Level     2
 * Question  1
 * Language  C
 * In a Loop
 */

#include <stdio.h>

int main()
{
    int k=0;

    if(k == 0) {
        printf("hello");
        break;
    }
    for(k=-3; k<-5; k++)
        printf("hello\n");
    continue;

    for (k=3; k>=-5; k++)
        printf("in for loop\n");
        printf("after loop\n");

}
/* end of arr.c */

/* Expected Output

hello
in for loop
after loop
*/





