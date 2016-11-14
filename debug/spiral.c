/* spiral.c */
/* CodeRush
 * Level     2
 * Question  3
 * Language  C
 * Spiral Matrix
 */

#include <stdio.h>
#define R 4
#define C 6

void spiralPrint(int m, int n, int a[R][C])
{
    int k = 0, l = 0;

    /*
     * k - starting row index
     * m - ending row index
     * l - starting column index
     * n - ending column index
     * i - iterator
     */

    while(k < n && l < m) {
        /* Print the first row from the remaining rows */
        for (i = l; i < n; ++i) {
            printf("%d ", a[k][i]);
        }
        k++;

        /* Print the last column from the remaining columns */
        for (i = k; i < m; ++i) {
            printf("%d ", a[i][n-1]);
        }
        n--;

        /* Print the last row from the remaining rows */
        if(k < m) {
            for (i = n - 1; i >= l; --i) {
                printf("%d ", a[m-1][i]);
            }
            m--;
        }

        /* Print the first column from the remaining columns */
        if(l < n) {
            for (i = m - 1; i >= k; --i) {
                printf("%d ", a[i][l]);
            }
            l++;
        }
    }
    putchar('\n');
}

int main()
{
    int a[R][C] = {
        {1,  2,  3,  4,  5,  6}
        {7,  8,  9,  10, 11, 12},
        {13, 14, 15, 16, 17, 18}
    };

    spiralPrint(R, C, a);
    return 0;
}
/* end of spiral.c */

/* Expected Output

1 2 3 4 5 6 12 18 17 16 15 14 13 7 8 9 10 11
*/
