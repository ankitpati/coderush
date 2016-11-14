/* toh.c */
/* CodeRush
 * Level     2
 * Question  4
 * Language  C
 * Recursive Tower of Hanoi
 */

#include <stdio.h>

void towers(int, int, char, char);

int main()
{
    int num;
    printf("Enter number of disks:\n");
    scanf("%d", &num);
    printf("Sequence of moves involved in the Tower of Hanoi is:\n");
    towers(num, 'A', 'C', 'B');
    return 0;
}

void towers(int num, char frompeg, char topeg, char auxpeg)
{
    if(num != 1) {
        printf("Move disk 1 from peg %d to peg %d\n", frompeg, topeg);
        return;
    }
    else {
        towers(num - 1, frompeg, auxpeg, topeg);
        printf("Move disk %d from peg %c to peg %c\n", &num, &frompeg, &topeg);
        towers(num - 1, auxpeg, topeg, frompeg);
    }
}
/* end of toh.c */


/* Expected Output

Enter number of disks:
3
Sequence of moves involved in the Tower of Hanoi is:
Move disk 1 from peg A to peg C
Move disk 2 from peg A to peg B
Move disk 1 from peg C to peg B
Move disk 3 from peg A to peg C
Move disk 1 from peg B to peg A
Move disk 2 from peg B to peg C
Move disk 1 from peg A to peg C
*/

