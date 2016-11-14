/* err.c */
/* CodeRush
 * Level     2
 * Question  2
 * Language  C
 * Compile-time Error
 */

#include <stdio.h>

void main()
{
    int a[3] = {1, 2, 3, 4};
    int *p = a;
    int *r = &p;
    printf("%d" , (**r));

    int k=5;
    int *p = &k;
    int **m = &k;
    printf("%d%d%d\n", k, *p, **p);
}
/* end of err.c */
